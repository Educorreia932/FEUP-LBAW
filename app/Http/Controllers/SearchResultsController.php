<?php
namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if ($request->has('fts') && strlen($request->fts)) {
            $query = $query->whereRaw("member.ts_search @@ plainto_tsquery('english', ?)", [$request->fts])
            ->orderByRaw("ts_rank(member.ts_search, plainto_tsquery('english', ?)) DESC", [$request->fts]);
        }

        // has auctions
        if ($request->has('filter_check') && $request->filter_check) {
            $query = $query->join('auction', 'member.id', '=', 'auction.seller_id');
        }

        // followed users
        if ($request->has('owner_filter') && $request['owner_filter'] !== 'all') {
            $query = $query->join('follow', 'followed_id', '=', 'member.id')
            ->where('follower_id', '=', Auth::user()->id);
        }

        // rating
        if ($request->has(['user_min_rating', 'user_max_rating'])) {
            $query = $query->where('rating', '>=', (int) $request['user_min_rating'])
            ->where('rating', '<=', (int) $request['user_max_rating']);
        }

        // join date left bound
        if ($request->has('join_from') && $request->join_from) {
            $query = $query->where('joined', '>=', $request['join_from']);
        }
    
         // join date right bound
        if ($request->has('join_to') && $request->join_to) {
            $query = $query->where('joined', '<=', $request['join_to']);
        }

        // sort 
        if ($request->has('sort') && $request->sort){
            if ($request->sort === 'rating') {
                $query->orderBy('rating');
            }
            else if ($request->sort === 'auctions') {
                $query = $query->selectRaw('member.*, COUNT(auction.seller_id) as num_auctions')
                ->leftJoin('auction', 'auction.seller_id', '=', 'member.id')
                ->groupBy('member.id')
                ->orderByDesc('num_auctions');
            }
            else if ($request->sort === 'date') {
                $query = $query->orderByDesc('joined');
            }
        }

        // display 5 members per page
        $members = $query->paginate(5);

        $request->flash();

        return view('pages.search.users')->with('members',$members); //view('pages.search.users', [ "members" => $members ]);
    }
}
