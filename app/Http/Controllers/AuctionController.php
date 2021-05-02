<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditRequest;
use App\Http\Requests\ReportRequest;
use App\Models\Auction;
use App\Models\AuctionImage;
use App\Http\Requests\CreateAuctionRequest;
use App\Models\AuctionReport;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class AuctionController extends Controller {
    public function show($id) {
        $auction = Auction::find($id);
        return view('pages.auction', ['auction' => $auction]);
    }

    public function showDetails($id) {
        $auction = Auction::find($id);

        return view('pages.auction_details', ['auction' => $auction]);
    }

    public function create() {
        return view('pages.create_auction');
    }

    public function store(CreateAuctionRequest $request) {
        // Validating request
        $validated = $request->validated();

        $auction = new Auction($validated);
        $auction->seller_id = Auth::user()->id;
        $auction->status = 'Scheduled';

        $auction->save();

        $auction_id = $auction->id;

        // Handle images
        if ($request->hasFile('image')) {
            // Create  images directory for this auction
            $path = public_path() . '/images/auctions/' . $auction_id;
            File::makeDirectory($path, $mode = 0777, true, true);

            $i = 0;
            foreach ($request->file('image') as $file) {

                if ($i > 0) {
                    $auction_image = AuctionImage::create(['auction_id' => $auction_id]);
                    $image_id = $auction_image->id;
                } else
                    $image_id = 'thumbnail';

                ImageHelper::save_auction_image($file, $path, $image_id);
                $i++;
            }
        }

        return Redirect::to('/');
    }

    public function report($id, ReportRequest $request) {
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

    public function edit($id, EditRequest $request) {
        // Validating request
        // $validated = $request->validated();

        $auction = Auction::find($id);

        if ($request->get("title") != null)
            $auction->title = $request->get("title");

        if ($request->get("description") != null)
            $auction->description = $request->get("description");

        $auction->update();

        return Redirect::to(route("auction", ["id" => $id]));
    }
}
