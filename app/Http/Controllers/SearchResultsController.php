<?php
namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SearchResultsController extends Controller {
    public function search_auctions(Request $request) {
        $query = Auction::query();

        // FTS - Full Text Search
        if ($request->has('fts') && strlen($request->fts)) {
            $query = $query->whereRaw("auction.ts_search @@ plainto_tsquery('english', ?)", [$request->fts])
            ->orderByRaw("ts_rank(auction.ts_search, plainto_tsquery('english', ?)) DESC", [$request->fts]);
        }

        // category filters
        if ($request->has('filter_check_game') && $request->filter_check_game)
            $query = $query->where('category', '=', 'Games');
        else if ($request->has('filter_check_book') && $request->filter_check_book)
            $query = $query->where('category', '=', 'E-Books');
        else if ($request->has('filter_check_music') && $request->filter_check_music)
            $query = $query->where('category', '=', 'Music');
        else if ($request->has('filter_check_sftw') && $request->filter_check_sftw)
            $query = $query->where('category', '=', 'Software');
        else if ($request->has('filter_check_skin') && $request->filter_check_skin)
            $query = $query->where('category', '=', 'Skins');
        else if ($request->has('filter_check_other') && $request->filter_check_other)
            $query = $query->where('category', '=', 'Others');

        // auction owner
        if ($request->has('owner_filter')) {
            if ($request->owner_filter === "follow") {

                Auth::check();
                $follows = DB::table("follow")->select('followed_id as id')->where('follower_id', '=', Auth::user()->id)->get();

                $final = [];
                foreach ($follows->toArray() as $key => $item) {
                    array_push($final, $item->id);
                }

                $query = $query->whereIn('seller_id', $final);     
            }
            else if ($request->owner_filter === "username") {
                $query = $query->select('auction.*')->join('member', 'member.id', '=', 'auction.seller_id')
                ->whereRaw("member.ts_search @@ plainto_tsquery('english', ?)", [$request->fts_user])
                ->orderByRaw("ts_rank(member.ts_search, plainto_tsquery('english', ?)) DESC", [$request->fts_user]);
            }
        }
        

        // Not sure this works
        $timeframe = [];
        if ($request->has('filter_check_sche') && $request->filter_check_sche) {
            array_push($timeframe, "Scheduled");
        }

        if ($request->has('filter_check_open') && $request->filter_check_open) {
            array_push($timeframe, "Active");
        }

        if ($request->has('filter_check_end') && $request->filter_check_end) {
            array_push($timeframe, "Closed");
        }

        if (!empty($timeframe)) {
            $query = $query->where('status', $timeframe);
        }

        // bid range
        // TODO: review credit calculation
        if ($request->has(['min_bid', 'max_bid'])) {
            if ($request->min_bid && $request->min_bid > 0)
                $query = $query->whereRaw('latest_bid / 100 >= ?', [(int) $request->min_bid]);
            if ($request->max_bid)
                $query = $query->whereRaw('latest_bid / 100 <= ?', [(int) $request->max_bid]);
        }

        // display 5 members per page
        $auctions = $query->paginate(5);

        $request->flash();

        return view('pages.search.auctions')->with('auctions', $auctions);
    }


    public function search_users(Request $request) {
        
        // select all members
        $query = Member::query(); 

        // FTS - Full Text Search
        if ($request->has('fts') && strlen($request->fts)) {
            $query = $query->whereRaw("member.ts_search @@ plainto_tsquery('english', ?)", [$request->fts])
            ->orderByRaw("ts_rank(member.ts_search, plainto_tsquery('english', ?)) DESC", [$request->fts]);
        }

        // selecting all users who have at least one auction
        if ($request->has('filter_check_auction') && $request->filter_check_auction) {
            $query = $query->whereExists(function($q) {
                $q->select(DB::raw(1))
                  ->from('auction')
                  ->whereColumn('auction.seller_id', 'member.id');
            });
        }

        // followed users
        if ($request->has('owner_filter') && $request['owner_filter'] !== 'all') {  // TODO FIX THIS QUER
            Auth::check();
            $query = $query->join('follow', 'followed_id', '=', 'member.id')
            ->where('follower_id', '=', Auth::user()->id);

            // dd($query->get());
        }

        // rating
        if ($request->has('user_min_rating') && $request->user_min_rating > 0) {
            $query = $query->select('member.*')
            ->join('rating', 'member.id' , '=', 'ratee_id')
            ->groupBy('member.id')
            ->havingRaw('(SUM(value) / COUNT(member.id))*100 >= ?', [$request->user_min_rating]);
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
