<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {
    public function show() {
        $open_auctions = Auction::all()->take(6);

        return view('pages.home', ["open_auctions" => $open_auctions]);
    }
}
