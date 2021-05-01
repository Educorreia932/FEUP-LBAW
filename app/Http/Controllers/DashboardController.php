<?php

namespace App\Http\Controllers;

use App\Models\Member;

class DashboardController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function createdAuctions() {
        $auctions = $this->user->createdAuctions;

        return view("pages.dashboard.created_auctions", [ "auctions" => $auctions ]);
    }

    public function biddedAuctions() {
        $auctions = $this->user->createdAuctions;

        return view("pages.dashboard.bidded_auctions", [ "auctions" => $auctions ]);
    }

    public function bookmarkedAuctions() {
        $auctions = $this->user->bookmarkedAuctions;

        return view("pages.dashboard.bookmarked_auctions", [ "auctions" => $auctions ]);
    }

    public function followed() {
        $followers = $this->user->follows;

        return view('pages.dashboard.followed', [ "followers" => $followers ]);
    }
}
