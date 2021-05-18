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
}
