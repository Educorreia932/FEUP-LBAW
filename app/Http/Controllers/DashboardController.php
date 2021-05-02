<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller {
    public function __construct() {
        parent::__construct();

        $this->middleware('auth');
    }

    public function createdAuctions() {
        $auctions = Auth::user()->createdAuctions;

        return view("pages.dashboard.created_auctions", [ "auctions" => $auctions ]);
    }

    public function biddedAuctions() {
        $auctions = Auth::user()->createdAuctions;

        return view("pages.dashboard.bidded_auctions", [ "auctions" => $auctions ]);
    }

    public function bookmarkedAuctions() {
        $auctions = Auth::user()->bookmarkedAuctions;

        return view("pages.dashboard.bookmarked_auctions", [ "auctions" => $auctions ]);
    }

    public function followed() {
        $followers = Auth::user()->follows;

        return view('pages.dashboard.followed', [ "followers" => $followers ]);
    }
}
