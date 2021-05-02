<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Helpers\LbawUtils;
use Carbon\Carbon;

class Auction extends Model {
    use HasFactory;

    protected $table = "auction";

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'nsfw' => 'false'
    ];

    /**
     * The attributes that are not mass fillable
     * @var array
     */
    protected $guarded = [
        'id', 'seller_id', 'latest_bid', 'ts_search'
    ];

    protected $hidden = [
        'seller_id', 'latest_bid', 'ts_search'
    ];

    public static function getCategoryNames() {
        return DB::select('SELECT unnest(enum_range(NULL::auction_category))::text');
    }

    public function getEndedAttribute() {
        return Carbon::now() > $this->end_date;
    }

    public function getStartedAttribute() {
        return Carbon::now() > $this->end_date;
    }

    public function getInterruptedAttribute() {
        return in_array($this->status, array('Canceled', 'Frozen', 'Terminated'));
    }

    public function getIncrementString() {
        if ($this->increment_fixed != null)
            return LbawUtils::formatCurrency($this->increment_fixed) . " φ";
        else
            return $this->increment_percent . " %";
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
            return ceil($this->latest->value * (100 + $this->increment_percent) / 100);
    }

    public function getNBiddersAttribute() {
        return $this->bids->groupBy('bidder_id')->count();
    }

    public function getNBidsAttribute() {
        return $this->bids->count();
    }

    public function getHasBidsAttribute() {
        return $this->latest_bid != null;
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

    public function getThumbnail($type='card') {
        return asset('images/auctions/' . $this->id . '/thumbnail_' . $type . '.jpg');
    }

    public function genImages($type='card') {
        foreach ($this->images as $img) {
            yield asset('images/auctions/' . $this->id . '/' . $img->id . '_' . $type . '.jpg');
        }
    }

    public function getTimeRemainingString(): string {
        if ($this->ended)
            return "Ended";
        return $this->end_date->diffForHumans();
    }
}
