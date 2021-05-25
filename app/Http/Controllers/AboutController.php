<?php

namespace App\Http\Controllers;

class AboutController extends Controller {
    public function about() {
        return view('pages.about');
    }

    public function faq() {
        return view('pages.faq');
    }
}
