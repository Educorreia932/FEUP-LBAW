<?php
namespace App\Http\Controllers;

class UserProfileController extends Controller {
    public function show() {
        return view('pages.user_profile');
    }
}
