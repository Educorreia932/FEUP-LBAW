<?php
namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Member;
use Illuminate\Http\Request;

class SearchResultsController extends Controller {
    public function search_auctions() {
        $auctions = Auction::all()->take(20);

        return view('pages.search.auctions', [ "auctions" => $auctions ]);
    }

    public function search_users(Request $request) {
        $members = Member::paginate(5);

        return view('pages.search.users', [ "members" => $members ]);
    }
}
