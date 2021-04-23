<?php
namespace App\Http\Controllers;

use App\Models\Auction;

class HomeController extends Controller {
    public function show() {
        $open_auctions = Auction::all()->take(6);

        return view('pages.home', ["open_auctions" => $open_auctions]);
    }
}
