<?php
namespace App\Http\Controllers;

use App\Models\Member;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        $this->authorize('update', Member::class);

        $rules = array(
            'name' => ['required_without_all:username,email'],
            'username' => ['required_without_all:name,email'],
            'email' => ['required_without_all:name,username']
        );

        $messages = array(
            'required_without_all' => 'At least one value must be not empty',
            'min' => ':attribute must have at least :min characters',
            'email' => 'Email :input is not a valid email',
            'unique' => ':attribute :input already exists'
        );
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

        try {
            $validated_data = $validator->validate();

            $id = Auth::id();
        
            $user = Member::findOrFail($id);

            if (!empty($validated_data['name'])) {
                $user->name = $validated_data['name'];
            }

            if (!empty($validated_data['username'])) {
                $user->username = $validated_data['username'];
            }

            if (!empty($validated_data['email'])) {
                $user->email = $validated_data['email'];
            }

            $user->save();

        } catch(ValidationException $e) {
            /*return response()->json([
                'message' => $e->getMessage()
            ], 400);*/
        } catch (ModelNotFoundException $e) {
            /*return response()->json([
                'message' => 'User was not found. Please try again.'
            ], 404);*/
        }
        return redirect()->back();
    }

    public function change_password(Request $request) {
        $this->authorize('change_password', Member::class);
    }
}
