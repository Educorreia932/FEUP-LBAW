<?php
namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Member;
use Carbon\Carbon;
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
        if ($request->has('filter_check_category')) {
            $categories = [];
            foreach (Auction::CATEGORY_FORM as $key => $value)
                if (in_array($value, $request->filter_check_category))
                    array_push($categories, $key);

            if (count($categories) > 0 && count($categories) < count(Auction::CATEGORY_FORM)) {
                $query = $query->whereIn('category', $categories);
            }
        }

        // auction owner
        if ($request->has('owner_filter')) {
            if ($request->owner_filter === "follow" && Auth::check()) {
                $query = $query->join('follow', 'follow.followed_id', '=', 'auction.seller_id')->where('follow.follower_id', '=', Auth::id());
            }
            else if ($request->owner_filter === "username") {
                $query = $query->select('auction.*')->join('member', 'member.id', '=', 'auction.seller_id')
                ->whereRaw("member.ts_search @@ plainto_tsquery('english', ?)", [$request->fts_user])
                ->orderByRaw("ts_rank(member.ts_search, plainto_tsquery('english', ?)) DESC", [$request->fts_user]);
            }
        }

        // NSFW
        $safety = 1;
        if (Auth::check() && $request->has('filter_check_nsfw')) {
            $safety = 0;
            if (in_array('sfw', $request->filter_check_nsfw))
                $safety += 1;
            if (in_array('nsfw', $request->filter_check_nsfw))
                $safety += 2;
        }

        switch ($safety) {
            case 0: // None
            case 3: // All
                break;
            case 1: // SFW
                $query = $query->where('nsfw', '=', 'FALSE');
                break;
            case 2: // NSFW
                $query = $query->where('nsfw', '=', 'TRUE');
                break;
        }

        // Auction timeframe
        $timeframe = 3;
        if ($request->has('filter_check_timeframe')) {
            $timeframe = 0;
            if (in_array('sched', $request->filter_check_timeframe))
                $timeframe += 1;
            if (in_array('open', $request->filter_check_timeframe))
                $timeframe += 2;
            if (in_array('end', $request->filter_check_timeframe))
                $timeframe += 4;
        }

        switch ($timeframe) {
            case 0: // None selected
            case 7: // All selected
                break;
            case 1: // Scheduled only
                $query = $query->where('start_date', '>', Carbon::now());
                break;
            case 2: // Open only
                $query = $query->where('start_date', '<', Carbon::now())
                    ->where('end_date', '>', Carbon::now());
                break;
            case 3: // Sheduled or open
                $query = $query->where('end_date', '>', Carbon::now());
                break;
            case 4: // Closed only
                $query = $query->where('end_date', '<', Carbon::now());
                break;
            case 5: // Closed or scheduled
                $query = $query->where(function($query)
                {
                    $query->orWhere('start_date', '>', Carbon::now())
                        ->orWhere('end_date', '<', Carbon::now());
                });
                break;
            case 6: // Closed or open
                $query = $query->where('start_date', '<', Carbon::now());
                break;
            default:
                break;
        }


        // bid range
        if ($request->has(['min_bid', 'max_bid'])) {
            if ($request->min_bid && $request->min_bid > 0)
                $query = $query->where('next_bid', '>=', round($request->min_bid * 100));
            if ($request->max_bid)
                $query = $query->where('next_bid', '<=', round($request->max_bid * 100));
        }


        // sort
        if ($request->has('sort') && $request->sort){
            if ($request->sort === 'price') {
                $query->orderBy('next_bid');
            }
            else if ($request->sort === 'time') {
                $query = $query->orderByDesc('end_date');
            }
            else if ($request->sort === 'date') {
                $query = $query->orderByDesc('start_date');
            }
        }

        // display 15 auctions per page
        $auctions = $query->paginate(15);

        $request->flash();

        return view('pages.search.search_auctions')->with('auctions', $auctions)->with('request', $request);
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
        if ($request->has('owner_filter') && $request['owner_filter'] !== 'all' && Auth::check()) {
            $query = $query->join('follow', 'followed_id', '=', 'member.id')
                            ->where('follower_id', '=', Auth::id());
        }

        // rating
        if ($request->has('user_min_rating') && $request->user_min_rating)
            $query = $query->where('rating', '>=', $request->user_min_rating);
        if ($request->has('user_max_rating') && $request->user_max_rating)
            $query = $query->where('rating', '<=', $request->user_max_rating);

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

        // display 15 members per page
        $members = $query->paginate(15);

        $request->flash();

        return view('pages.search.search_users')->with('members', $members)->with('request', $request);
    }
}
