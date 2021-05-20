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

        $reports = $query->paginate(15);
        // dd($reports);

        $request->flash();
        return view('pages.admin.user_management', [ "user" => Auth::guard('admin')->user(), "reports" => $reports]);
    }

    public function reportedUsers() {

        $query = DB::table('user_report')
                    ->join('member', 'reported_id', 'member.id')
                    ->select('user_report.*', 'member.id as member_id',  'username');
        
        $reports = $query->paginate(15);
        return view('pages.admin.reported_users',  [ "user" => Auth::guard('admin')->user(), "reports" => $reports]);
    }

    
}
