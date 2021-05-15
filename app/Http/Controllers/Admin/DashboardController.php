<?php

namespace App\Http\Controllers\Admin;

use App\Models\Auction;
use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller {
    public function __construct() {
        parent::__construct();

        $this->middleware('admin');
    }

    public function manageUsers() {
        return view("pages.admin.user_management");
    }
}
