<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Auction;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showHome() {
        return view('pages.admin.user_management', [ "user" => Auth::guard('admin')->user()]);
    }
}
