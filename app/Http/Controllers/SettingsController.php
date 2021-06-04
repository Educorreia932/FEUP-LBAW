<?php
namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class SettingsController extends Controller {

    public function __construct() {
        parent::__construct();

        $this->middleware('auth');
    }

    public function account() {
        return view('pages.settings.account');
    }

    public function privacy() {
        return view('pages.settings.privacy');
    }

    public function security() {
        return view('pages.settings.security');
    }

    public function save_account_changes(Request $request) {
        $this->authorize('update', $request->user());

        $user = Member::findOrFail(Auth::id());

        $rules = array(
            'bio' => ['nullable', 'max: 500']
        );

        $messages = array(
            'required_without_all' => 'At least one value must be not empty',
            'min' => ':attribute must have at least :min characters',
            'email' => 'Email :input is not valid',
            'unique' => ':attribute :input already exists'
        );

        // Bio unchanged
        if ($request['bio'] === $user->bio) {
            $rules['name'] = ['required_without_all:username,email,image'];
            $rules['username'] = ['required_without_all:name,email,image'];
            $rules['email'] = ['required_without_all:name,username,image'];
            $rules['image'] = ['required_without_all:name,username,email'];
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        $validator->sometimes('name', 'required|min:1', function ($input) {
            return !empty($input->name);
        });
        $validator->sometimes('username', 'required|min:3|unique:App\Models\Member,username|unique:App\Models\Admin,username', function ($input) {
            return !empty($input->username);
        });
        $validator->sometimes('email', 'required|email:rfc,dns|unique:App\Models\Member,email', function ($input) {
            return !empty($input->email);
        });

        $validator->sometimes('image', 'required|file|image', function ($input) {
            return !empty($input->image);
        });

        try {
            $validated_data = $validator->validate();

            $user->bio = $validated_data['bio'];

            if (!empty($validated_data['name'])) {
                $user->name = $validated_data['name'];
            }

            if (!empty($validated_data['username'])) {
                $user->username = $validated_data['username'];
            }

            if (!empty($validated_data['email'])) {
                $user->email = $validated_data['email'];
            }

            if (!empty($validated_data['image'])) {
                $path = public_path() . '/images/users/';

                ImageHelper::save_user_image($validated_data['image'], $path, Auth::id());
            }

            $user->save();

        } catch(ValidationException $e) {
            return redirect()->back()->with(
                'error',
                $validator->errors()->all()
            );
        }
        return redirect()->back()->with(
            'success',
            ['Account changes saved!']
        );
    }

    public function change_password(Request $request) {
        $this->authorize('change_password', $request->user());

        $rules = array(
            'pwd' => ['required', 'filled', 'string'],
            'new-pwd' => ['required', 'filled', 'string'],
            'confirmed-pwd' => ['required', 'filled', 'string', 'same:new-pwd']
        );

        $messages = array(
            'same' => 'Passwords must match.'
        );

        $validator = Validator::make($request->all(), $rules, $messages);

        try {

            $validated_data = $validator->validate();

            $id = Auth::id();

            $user = Member::findOrFail($id);

            $current_pwd = $validated_data['pwd'];
            $new_pwd = $validated_data['new-pwd'];

            if (!Hash::check($current_pwd, $user->password)) {
                return redirect()->back()->with(
                    'error', ['Current password is incorrect.']
                );
            }

            $user->password = Hash::make($new_pwd);

            $user->save();
        } catch (ValidationException $e) {
            return redirect()->back()->with(
                'error',
                $validator->errors()->all()
            );
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with(
                'error',
                ['This user doesn\'t exist.']
            );
        }

        return redirect()->back()->with(
            "success", ["Password changed successfully."]
        );
    }

    public function delete_account(Request $request) {
        $this->authorize('delete', $request->user());

        try {
            $id = Auth::id();

            $user = Member::findOrFail($id);

            $createdAuctions = $user->createdAuctions()->get();

            foreach ($createdAuctions as $auction) {
                if ($auction->getOpenAttribute()) {
                    return redirect()->back()->with(
                        'error',
                        ['There are auctions still active in your account.']
                    );
                }
            }

            $recentAuctions = $user->createdAuctions()
                            ->where('end_date', '>', Carbon::now()->subWeek())
                            ->get();

            if (!$recentAuctions->isEmpty()) {
                return redirect()->back()->with(
                    'error',
                    ['You have auctions that ended recently. Please wait a week after your actions ended to delete your account.']
                );
            }

            // ACCOUNT DELETION
            foreach ($createdAuctions as $auction) {
                (new AdminController)->terminateAuction($auction->id);
            }

            // User fields -> null except id
            $user->delete_info();
            Auth::logout();
            $user->save();

            DB::table('follow')->where('follower_id', $id)
                                ->orWhere('followed_id', $id)->delete();

            DB::table('rating')->where('ratee_id', $id)
                                ->orWhere('rater_id', $id)->delete();

            DB::table('bookmarked_auction')->where('member_id', $id)->delete();

            File::delete(public_path($user->getRawImagePath('original')));
            File::delete(public_path($user->getRawImagePath('medium')));
            File::delete(public_path($user->getRawImagePath('small')));

        } catch (ValidationException $e) {
            return response()->json(array(
                'error' => 'Account could not be deleted'
            ));
        } catch (ModelNotFoundException $e) {
            response()->json(array(
                "error" => "User doesn't exist"
            ));
        }
        return redirect()->route('home')->with(
            "success", ["Account deleted."]
        );
    }

    public function toggle_settings(Request $request) {
        $this->authorize('toggle_privacy_settings', $request->user());

        $rules = array(
            "setting" => ['required', 'string', Rule::in(['nsfw_consent', 'data_consent', 'notifications', 'outbid_notifications', 'start_auction_notifications', 'followed_user_activity'])]
        );

        $messages = array(
            "in" => "Invalid request."
        );

        $validator = Validator::make($request->all(), $rules, $messages);

        try {

            $validated_data = $validator->validate();

            $id = Auth::id();

            $user = Member::findOrFail($id);

            $setting = $validated_data['setting'];

            $user[$setting] = !$user[$setting];

            $user->save();

        } catch (ValidationException $e) {
            return response()->json(
                $validator->errors()->all(), 400
            );
        } catch (ModelNotFoundException $e) {
            response()->json(array(
                "error" => "User doesn't exist"
            ));
        }

        return response()->json(array(
            "success" => "Saved changes!"
        ));
    }
}
