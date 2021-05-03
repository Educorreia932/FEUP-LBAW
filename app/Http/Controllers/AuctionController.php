<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditRequest;
use App\Http\Requests\ReportRequest;
use App\Models\Auction;
use App\Models\AuctionImage;
use App\Http\Requests\CreateAuctionRequest;
use App\Models\AuctionReport;
use App\Helpers\ImageHelper;
use App\Models\BookmarkedAuction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuctionController extends Controller {
    public function show($id) {
        $auction = Auction::find($id);

        if ($auction == null)
            return abort(404);

        if (!Auth::check() || ($auction->nsfw && !Auth::user()->nsfw_consent))
            return back();

        return view('pages.auction', ['auction' => $auction]);
    }

    public function showDetails($id) {
        $auction = Auction::find($id);

        if ($auction == null)
            return abort(404);

        if (!Auth::check() || ($auction->nsfw && !Auth::user()->nsfw_consent))
            return back();

        return view('pages.auction_details', ['auction' => $auction]);
    }

    public function create() {
        return view('pages.create_auction');
    }

    public function bookmark($id) {
        DB::table('bookmarked_auction')->insert([
            'auction_id' => $id,
            'member_id' => Auth::id()
        ]);
    }

    public function unbookmark($id) {
        DB::table('bookmarked_auction')->where('member_id', '=', Auth::id())->where('auction_id', '=', $id)->delete();
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
        // Validating request
        $validated = $request->validated();
        $validated["reported_id"] = $id;

        AuctionReport::create($validated);

        return Redirect::to(route("auction", ["id" => $id]));
    }

    public function edit($id, EditRequest $request) {
        // Validating request
        $validated = $request->validated();

        $auction = Auction::find($id);
        $auction->update($validated);

        return Redirect::to(route("auction", ["id" => $id]));
    }
}
