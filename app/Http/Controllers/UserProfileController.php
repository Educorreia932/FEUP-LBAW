<?php
namespace App\Http\Controllers;

use App\Models\Member;

class UserProfileController extends Controller {
    public function show($username) {
        if ($username == 'me')
            $user = Member::all()->first();

        else
            $user = Member::all()->where('username', '=', $username)->first();

        return view('pages.user_profile', [ "user" => $user]);
    }
}
