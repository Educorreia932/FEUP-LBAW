<?php

namespace App\Policies;

use App\Models\Member;
use App\Models\Auction;

use Illuminate\Auth\Access\HandlesAuthorization;

class AuctionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view an auction.
     *
     * @param  \App\Models\Member  $member
     * @param  \App\Models\Auction  $auction
     * @return mixed
     */
    public function view(?Member $member, Auction $auction) {
        return !$auction->nsfw || optional($member)->nsfw_consent;
    }

    /**
     * Determine whether the user can view an auction.
     *
     * @param  \App\Models\Member  $member
     * @return mixed
     */
    public function viewNsfw(Member $member) {
        return $member->nsfw_consent;
    }

    /**
     * Determine whether the user can create an auction.
     *
     * @param  \App\Models\Member  $member
     * @return mixed
     */
    public function sell(Member $member)
    {
        return $member->sell_permission && !$member->banned;
    }

    /**
     * Determine whether the user can bid on an auction.
     *
     * @param  \App\Models\Member  $member
     * @param  \App\Models\Auction  $auction
     * @return mixed
     */
    public function bid(Member $member, Auction $auction) {
        return $member->sell_permission
            && !$member->banned
            && $auction->open
            && $member->id != $auction->seller_id
            && !$auction->holdsLatestBid($member->id);
    }

    /**
     * Determine whether the user can bid on an auction.
     *
     * @param  \App\Models\Member  $member
     * @param  \App\Models\Auction  $auction
     * @return mixed
     */
    public function edit(Member $member, Auction $auction) {
        return $member->id == $auction->seller_id && $auction->scheduled;
    }

    /**
     * Determine whether the user can bid on an auction.
     *
     * @param  \App\Models\Member  $member
     * @param  \App\Models\Auction  $auction
     * @return mixed
     */
    public function report(Member $member, Auction $auction) {
        return !$member->banned && $member->id != $auction->seller_id;
    }
}
