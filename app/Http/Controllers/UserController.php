<?php

namespace App\Http\Controllers;

use App\Http\Requests\RateUserRequest;
use App\Models\Member;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller {
    public function showProfile($username) {
        $user = Member::all()->where('username', '=', $username)->first();
        if ($user == null)
            return abort(404);

        return view('pages.user_profile', ["user" => $user]);
    }

    public function showMyProfile() {
        return view('pages.user_profile', ["user" => Auth::user()]);
    }

    public function rate($username, RateUserRequest $request) {
        $user = Member::all()->where('username', '=', $username)->first();

        $validated = $request->validated();

        // User had already been rated
        if (Auth::user()->ratedUser($user->id))
            Rating::where("ratee_id", $user->id)
                ->where("rater_id", Auth::id())
                ->update(["value" => $validated["value"]]);

        else
            Rating::create([
                'value' => $validated["value"],
                "ratee_id" => $user->id,
                "rater_id" => Auth::id()
            ]);

        return redirect(route("user_profile", [ "username" => $username]));
    }

    public function follow($username) {
        $user = Member::all()->where('username', '=', $username)->first();

        if ($user == null)
            return;

        DB::table('follow')->insert([
            'follower_id' => Auth::id(),
            'followed_id' => $user->id
        ]);
    }

    public function unfollow($username) {
        $user = Member::all()->where('username', '=', $username)->first();

        if ($user == null)
            return;

        DB::table('follow')->where('follower_id', '=', Auth::id())->where('followed_id', '=', $user->id)->delete();
    }
}
