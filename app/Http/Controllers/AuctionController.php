<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditRequest;
use App\Http\Requests\ReportRequest;
use App\Models\Auction;
use App\Models\AuctionImage;
use App\Http\Requests\CreateAuctionRequest;
use App\Models\AuctionReport;
use App\Helpers\ImageHelper;
use App\Models\Bid;
use App\Models\BookmarkedAuction;
use Dotenv\Exception\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuctionController extends Controller {
    public function show($id) {
        $auction = Auction::findOrFail($id);
        $this->authorize('view', $auction);

        return view('pages.auction', ['auction' => $auction]);
    }

    public function showDetails($id) {
        $auction = Auction::findOrFail($id);
        $this->authorize('view', $auction);

        return view('pages.auction_details', ['auction' => $auction]);
    }

    public function create() {
        $this->authorize('sell', Auction::class);
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

    public function bid(Request $request, $id) {
        $auction = Auction::findOrFail($id);
        $this->authorize('bid', $auction);

        if (!$request->has('bid'))
            abort(400);

        $request->merge(['bid' => intval(preg_replace("/[^0-9]/", "", $request['bid']))]);

        // Validate request
        $rules = array(
            'bid' => ['required', 'integer', 'min:' . $auction->next_bid],
        );

        $messages = array(
            'min' => ':attribute must be at least :min φ',
        );
        $validator = Validator::make($request->all(), $rules, $messages);

        try {
            $data = $validator->validate();

            $bid = Bid::create([
                'auction_id' => $id,
                'bidder_id' => Auth::id(),
                'value' => $data['bid'],
            ]);

            $bid->save();

        } catch(ValidationException $e) {
            dd($e->getMessage());
            /*return response()->json([
                'message' => $e->getMessage()
            ], 400);*/
        } catch (ModelNotFoundException $e) {
            /*return response()->json([
                'message' => 'User was not found. Please try again.'
            ], 404);*/
        }
        return redirect()->back();
    }

    public function store(CreateAuctionRequest $request) {
        $this->authorize('sell', Auction::class);

        // Validating request
        $validated = $request->validated();

        $auction = new Auction($validated);
        $auction->seller_id = Auth::id();
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

        return Redirect::to(route('auction', ['id', $auction->id]));
    }

    public function report($id, ReportRequest $request) {
        $auction = Auction::findOrFail($id);
        $this->authorize('report', $auction);

        // Validating request
        $validated = $request->validated();
        $validated["reported_id"] = $id;

        AuctionReport::create($validated);

        return Redirect::to(route("auction", ["id" => $id]));
    }

    public function edit($id, EditRequest $request) {
        $auction = Auction::findOrFail($id);
        $this->authorize('edit', $auction);

        // Validating request
        $validated = $request->validated();
        $auction->update($validated);

        return Redirect::to(route("auction", ["id" => $id]));
    }
}
