<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $auctions = Auction::query()
            ->select(DB::raw('auction.*, max(bid.date) AS latest_bid_date'))
            ->join('bid', 'bid.auction_id', '=', 'auction.id')
            ->where('bid.bidder_id', '=', Auth::id())
            ->groupBy('auction.id')
            ->orderBy('latest_bid_date', 'desc')
            ->get();

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
