<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Helpers\LbawUtils;

class Auction extends Model {
    use HasFactory;

    protected $table = "auction";

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public static function getCategoryNames() {
        return DB::select('SELECT unnest(enum_range(NULL::auction_category))::text');
    }

    public function getEndedAttribute() {
        return date_create() > $this->ended_date;
    }

    public function getIncrementString() {
        if ($this->increment_fixed != null)
            return LbawUtils::formatCurrency($this->increment_fixed) . " φ";
        else
            return $this->increment_percent . " %";
    }

    public function getTimeRemainingAttribute() {
        return date_create()->diff($this->end_date);
    }

    public function getDurationAttribute() {
        return $this->end_date->diff($this->start_date);
    }

    public function getCurrentBidAttribute() {
        return $this->latest == null ? null : $this->latest->value;
    }

    public function getNextBidAttribute() {
        if ($this->latest == null)
            return $this->starting_bid;
        if ($this->increment_fixed != null)
            return $this->latest->value + $this->increment_fixed;
        else
            return $this->latest->value * (1 + $this->increment_percent);
    }

    public function getNBiddersAttribute() {
        return $this->bids->groupBy('bidder_id')->count();
    }

    public function getNBidsAttribute() {
        return $this->bids->count();
    }

    public function images() {
        return $this->hasMany(AuctionImage::class, "auction_id", "id");
    }

    public function bids() {
        return $this->hasMany(Bid::class, "auction_id", "id");
    }

    public function latest() {
        return $this->hasOne(Bid::class, "id", "latest_bid");
    }

    public function seller() {
        return $this->hasOne(Member::class, "id", "seller_id");
    }

    public function getThumbnailCard() {
        return asset('images/auctions/' . $this->id . '/thumbnail_card.png');
    }

    public function getTimeRemainingString(): string {
        if ($this->ended)
            return "Ended";
        return LbawUtils::time_elapsed_string($this->time_remaining);
    }

    public function getDurationString(): string {
        $s =  LbawUtils::time_diff_string($this->duration, false);
        return implode(', ', $s);
    }

}
