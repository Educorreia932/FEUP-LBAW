<?php
namespace App\Http\Controllers;

class SettingsController extends Controller {
    public function account() {
        return view('pages.settings.account');
    }

    public function privacy() {
        return view('pages.settings.privacy');
    }

    public function security() {
        return view('pages.settings.security');
    }
}
