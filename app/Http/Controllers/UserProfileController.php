<?php
namespace App\Http\Controllers;

use App\Models\Member;

class UserProfileController extends Controller {
    public function show() {
        $user = Member::all()->first();

        return view('pages.user_profile', [ "user" => $user]);
    }
}
