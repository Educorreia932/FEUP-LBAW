<?php

namespace App\Http\Controllers;

use App\Models\Member;

class DashboardController extends Controller {
    public function show() {
        return view('pages.dashboard');
    }

    public function followers() {
        $member = Member::all()->first();
        $followers = $member->followers()->getResults();

        return view('pages.dashboard', [ "followers" => $followers ]);
    }
}
