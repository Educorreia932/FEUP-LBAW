<?php

namespace App\Http\Controllers;

use App\Models\Member;

class DashboardController extends Controller {
    public function createdAuctions() {
        $member = Member::all()->first();
        $auctions = $member->createdAuctions;

        return view("pages.dashboard.created_auctions", [ "auctions" => $auctions ]);
    }

    public function biddedAuctions() {
        $member = Member::all()->first();
        $auctions = $member->createdAuctions;

        return view("pages.dashboard.bidded_auctions", [ "auctions" => $auctions ]);
    }

    public function bookmarkedAuctions() {
        $member = Member::all()->first();
        $auctions = $member->bookmarkedAuctions;

        return view("pages.dashboard.bookmarked_auctions", [ "auctions" => $auctions ]);
    }

    public function followed() {
        $member = Member::all()->first();
        $followers = $member->follows;

        return view('pages.dashboard.followed', [ "followers" => $followers ]);
    }
}
