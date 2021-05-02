<?php
namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller {
    public function show($username) {
        $user = Member::all()->where('username', '=', $username)->first();

        return view('pages.user_profile', [ "user" => $user]);
    }

    public function showMe() {
        return view('pages.user_profile', [ "user" => Auth::user()]);
    }
}
