<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\AuctionImage;
use App\Http\Requests\CreateAuctionRequest;
use Illuminate\Support\Arr;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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

        // validating request
        $validated = $request->validated();

        $auction = new Auction($validated);
        $auction->seller_id = 1; # TODO Auth::user()->id
        $auction->status = 'Scheduled';
        
        $auction->save();

        $auction_id = $auction->id;

        // handle images
        if ($request->hasFile('image')) {

            // create  images directory for this auction
            $path = public_path().'/images/auctions/' . $auction_id;
            File::makeDirectory($path, $mode = 0777, true, true);
            
            $i = 0;
            foreach($request->file('image') as $file) {
                
                if ($i > 0) {
                    $auction_image = AuctionImage::create(['auction_id' => $auction_id]);
                    $image_id = $auction_image->id;
                }
                else 
                    $image_id = 'thumbnail';
                
                ImageHelper::save_image($file, $path, $image_id);

                // $name = $i."_"."original.".$file->extension();
                // $file->move($path, $name);
                $i++;
            }
        }

        // TODO create auction image
       
        return Redirect::to('/');
    }
}
