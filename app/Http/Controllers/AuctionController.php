<?php

namespace App\Http\Controllers;

use App\Models\Auction;

class AuctionController extends Controller {
    public function show($id) {
        $auction = Auction::find($id);
        return view('pages.auction', ['auction' => $auction]);
    }

    public function showDetails($id) {
        $auction = Auction::find($id);
        return view('pages.auction_details', ['auction' => $auction]);
    }
}
