<?php
namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Member;

class SearchResultsController extends Controller {
    public function search_auctions() {
        $auctions = Auction::all()->take(20);

        return view('pages.search', [ "auctions" => $auctions ]);
    }

    public function search_users() {
        $members = Member::all()->take(20);

        return view('pages.search', [ "members" => $members ]);
    }
}
