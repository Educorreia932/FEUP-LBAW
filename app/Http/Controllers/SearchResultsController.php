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
        // dd($request['user-min-rating']);
        
        // select all members
        $query = Member::query(); 

        // FTS - Full Text Search
        if ($request->has('fts')) {
            $query = $query->whereRaw("ts_search @@ plainto_tsquery('english', ?)", [$request->fts])
            ->orderByRaw("ts_rank(ts_search, plainto_tsquery('english', ?))", [$request->fts]);
        }
    
        // display 5 members per page
        $members = $query->paginate(5);

        return view('pages.search.users')->with('members',$members);; //view('pages.search.users', [ "members" => $members ]);
    }
}
