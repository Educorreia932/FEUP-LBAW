<?php

namespace App\Http\Controllers\Admin;

use App\Models\Auction;
use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller {
    public function __construct() {
        parent::__construct();

        $this->middleware('admin');
    }

    // ======================
    //        USERS
    // ======================
    public function manageUsers(Request $request) {
        // select only reported users
        if ($request->has('filter') && $request->filter === 'report'){
            $query = DB::table('user_report')
                    ->join('member', 'reported_id', 'member.id')
                    ->select('user_report.*', 'member.id as member_id',  'username', 'joined', 'banned', 'sell_permission', 'bid_permission');
        }
        else {
            // select all users
            $query = Member::query();
            $query = $query->leftJoin('user_report', 'user_report.reported_id', 'member.id')
                        ->select('user_report.*', 'member.id as member_id', 'username', 'joined', 'banned', 'sell_permission', 'bid_permission');
        }

        // search by username
        if ($request->has('fts') && strlen($request->fts)) {
            $query = $query->whereRaw("member.ts_search @@ plainto_tsquery('english', ?)", [$request->fts])
            ->orderByRaw("ts_rank(member.ts_search, plainto_tsquery('english', ?)) DESC", [$request->fts]);
        }

        $reports = $query->paginate(10);
        // dd($reports);

        $request->flash();
        return view('pages.admin.user_management', [ "user" => Auth::guard('admin')->user(), "reports" => $reports]);
    }

    public function reportedUsers(Request $request) {

        $query = DB::table('user_report')
                    ->join('member', 'reported_id', 'member.id')
                    ->select('user_report.*', 'member.id as member_id',  'username')
                    ->orderByDesc('user_report.timestamp');
        
        // search by username
        if ($request->has('fts') && strlen($request->fts)) {
            $query = $query->whereRaw("member.ts_search @@ plainto_tsquery('english', ?)", [$request->fts])
            ->orderByRaw("ts_rank(member.ts_search, plainto_tsquery('english', ?)) DESC", [$request->fts]);
        }

        $reports = $query->paginate(15);

        $request->flash();

        return view('pages.admin.reported_users',  [ "user" => Auth::guard('admin')->user(), "reports" => $reports]);
    }

    /**
     * Show every report of a specific user
     */
    public function userReports($username) {
        $query = DB::table('user_report')
                    ->leftJoin('member', 'reported_id', 'member.id')
                    ->select('user_report.*', 'member.id as member_id',  'username')
                    ->where('username', $username)
                    ->orderByDesc('user_report.timestamp');

        $user_reports = $query->paginate(15);

        return view('pages.admin.reported_users',  [ "user" => Auth::guard('admin')->user(), "reports" => $user_reports, "detail_search" => $username]); 
    }


    // ======================
    //        AUCTIONS
    // ======================
    public function manageAuctions(Request $request) {
        // select only reported users
        if ($request->has('filter') && $request->filter === 'report'){
            $query = DB::table('auction_report')
                    ->join('auction', 'reported_id', 'auction.id')
                    ->select('auction_report.*', 'auction.id as auction_id', 
                            'auction.title as title',  'start_date', 'end_date', 'status');
        }
        else {
            // select all users
            $query = Auction::query();
            $query = $query->leftJoin('auction_report', 'auction_report.reported_id', 'auction.id')
                        ->select('auction_report.*', 'auction.id as auction_id', 
                                'auction.title as title',  'start_date', 'end_date', 'status');
        }

        $reports = $query->paginate(10);

        $request->flash();

        return view('pages.admin.auction_management', ['user' => Auth::guard('admin')->user(), 'reports' => $reports]);
    }

    public function reportedAuctions(Request $request) {

        $query = DB::table('auction_report')
                    ->join('auction', 'reported_id', 'auction.id')
                    ->select('auction_report.*', 'auction.id as auction_id',  'title')
                    ->orderByDesc('auction_report.timestamp');

        // search by auction name
        if ($request->has('fts') && strlen($request->fts)) {
            $query = $query->whereRaw("auction.ts_search @@ plainto_tsquery('english', ?)", [$request->fts])
            ->orderByRaw("ts_rank(auction.ts_search, plainto_tsquery('english', ?)) DESC", [$request->fts]);
        }

        $reports = $query->paginate(15);
        $request->flash();
        return view('pages.admin.reported_auctions', ['user' => Auth::guard('admin')->user(), 'reports' => $reports]);
    }

    /**
     * Show every report of a specific auction
     */
    public function auctionReports($id) {

        $title = Auction::findOrFail($id)->title;

        $query = DB::table('auction_report')
                    ->leftJoin('auction', 'reported_id', 'auction.id')
                    ->select('auction_report.*', 'title')
                    ->where('auction.id', $id)
                    ->orderByDesc('auction_report.timestamp');

        $user_reports = $query->paginate(15);

        return view('pages.admin.reported_auctions',  [ "user" => Auth::guard('admin')->user(), "reports" => $user_reports, "detail_search" => $title]); 
    }

    
}
