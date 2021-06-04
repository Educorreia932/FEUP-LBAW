<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Auction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Member;

class AdminController extends Controller
{
    public function banUser($id) {
        $member = Member::findOrFail($id);
        $member->banned = true;
        $member->save();

        return response()->json(["Ok" => "User banned"]);
    }

    public function unbanUser($id) {
        $member = Member::findOrFail($id);
        $member->banned = false;
        $member->save();

        return response()->json(["Ok" => "User unbanned"]);
    }

    public function revokeSell($id) {
        $member = Member::findOrFail($id);
        $member->sell_permission = false;
        $member->save();

        return response()->json(["Ok" => "Selling permission revoked"]);
    }

    public function restoreSell($id) {
        $member = Member::findOrFail($id);
        $member->sell_permission = true;
        $member->save();

        return response()->json(["Ok" => "Selling permission restored"]);
    }

    public function revokeBid($id) {
        $member = Member::findOrFail($id);
        $member->bid_permission = false;
        $member->save();

        return response()->json(["Ok" => "Bidding permission revoked"]);
    }

    public function restoreBid($id) {
        $member = Member::findOrFail($id);
        $member->bid_permission = true;
        $member->save();

        return response()->json(["Ok" => "Bidding permission restored"]);
    }

    public function terminateAuction($id) {
        $auction = Auction::findOrFail($id);
        $auction->status = "Terminated";
        $auction->save();

        // TODO: return user money
        return response()->json(["Ok" => "Auction Terminated"]);
    }

    public function activateAuction($id) {
        $auction = Auction::findOrFail($id);
        $auction->status = "Active";
        $auction->save();

        return response()->json(["Ok" => "Auction Activated"]);
    }
}
