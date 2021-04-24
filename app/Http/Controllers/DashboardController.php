<?php

namespace App\Http\Controllers;

use App\Models\Member;

class DashboardController extends Controller {
    public function createdAuctions() {
        $member = Member::all()->first();
        $auctions = $member->createdAuctions()->getResults();

        return view("pages.dashboard.created_auctions", [ "auctions" => $auctions ]);
    }

    public function biddedAuctions() {
        return view("pages.dashboard.bidded_auctions");
    }

    public function bookmarkedAuctions() {
        $member = Member::all()->first();
        $auctions = $member->bookmarkedAuctions()->getResults();

        return view("pages.dashboard.bookmarked_auctions", [ "auctions" => $auctions ]);
    }

    public function followed() {
        $member = Member::all()->first();
        $followers = $member->followers()->getResults();

        return view('pages.dashboard.followed', [ "followers" => $followers ]);
    }
}
