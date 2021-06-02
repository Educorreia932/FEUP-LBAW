<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;
use PHPUnit\Util\Exception;

class SocialController extends Controller {
    public function redirect($provider) {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider) {
        try {
            $get_info = Socialite::driver($provider)->user();
        } catch (InvalidStateException $e) {
            return redirect(route("auth_redirect", ["provider" => $provider]));
        }

        $user = $this->createUser($get_info, $provider);

        auth()->login($user);

        return redirect()->to(route("home"));
    }

    public function createUser($get_info, $provider) {
        $user = Member::where('github_id', $get_info->id)->first();

        if (!$user) {
            $user = Member::create([
                "username" => $get_info->nickname,
                'name' => $get_info->name,
                'email' => $get_info->email,
                'provider' => $provider,
                'github_id' => $get_info->id
            ]);
        }

        return $user;
    }
}
