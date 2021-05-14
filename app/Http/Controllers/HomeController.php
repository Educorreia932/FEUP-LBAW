<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller {
    public function show() {
        $open_auctions = Auction::all()
            ->where('start_date', '<', Carbon::now())
            ->where('end_date', '>', Carbon::now())
            ->take(6);

        $vars = ["open_auctions" => $open_auctions];

        if (Auth::check()) {
            $vars["followed_auctions"] = Auction::query()->join('follow', 'follow.followed_id', '=', 'auction.seller_id')
                ->where('follow.follower_id', '=', Auth::id())
                ->take(3)->get();

            $vars["bidded_auctions"] = Auction::query()
                ->select(DB::raw('auction.*, max(bid.date) AS latest_bid_date'))
                ->join('bid', 'bid.auction_id', '=', 'auction.id')
                ->where('bid.bidder_id', '=', Auth::id())
                ->groupBy('auction.id')
                ->orderBy('latest_bid_date', 'desc')
                ->take(3)->get();
        }

        return view('pages.home', $vars);
    }
}
