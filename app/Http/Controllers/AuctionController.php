<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\AuctionReport;
use Illuminate\Http\Request;

class AuctionController extends Controller {
    public function show($id) {
        $auction = Auction::find($id);
        return view('pages.auction', ['auction' => $auction]);
    }

    public function showDetails($id) {
        $auction = Auction::find($id);

        return view('pages.auction_details', ['auction' => $auction]);
    }

    public function report($id, Request $request) {
        $report_reason = "";

        switch ($request->get("report-reason")) {
            case 1:
                $report_reason = "Fraudalent Auction";
                break;
            case 2:
                $report_reason = "Improper product pictures";
                break;
            case 3:
                $report_reason = "Improper auction title";
                break;
            case 4:
                $report_reason = "Other";
                break;
        }

        $report = AuctionReport::create([
            "reason" => $report_reason,
            "description" => $request->get("report-description"),
            "reporter_id" => $request->get("reporter"),
            "reported_id" => $id
        ]);
    }
}
