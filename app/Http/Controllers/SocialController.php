<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller {
    public function redirect($provider) {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider) {
        $get_info = Socialite::driver($provider)->user();
        $user = $this->createUser($get_info, $provider);

        auth()->login($user);

        return $this->redirect(route("home"));
    }
}
