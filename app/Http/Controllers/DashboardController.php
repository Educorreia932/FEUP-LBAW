<?php

namespace App\Http\Controllers;

use App\Models\Member;

class DashboardController extends Controller {
    public function created_auctions() {
        return view("pages.dashboard.created_auctions");
    }

    public function bidded_auctions() {
        return view("pages.dashboard.bidded_auctions");
    }

    public function bookmarked_auctions() {
        return view("pages.dashboard.bookmarked_auctions");
    }

    public function followed() {
        $member = Member::all()->first();
        $followers = $member->followers()->getResults();

        return view('pages.dashboard.followed', [ "followers" => $followers ]);
    }
}
