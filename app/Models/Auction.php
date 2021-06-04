<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Helpers\LbawUtils;
use Carbon\Carbon;

use function PHPUnit\Framework\returnSelf;

class Auction extends Model {
    use HasFactory;

    protected $table = "auction";

    const STATUS = [
        'Active', 'Terminated'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Sets the format of datetimes in this model
     *
     * @var string
     */
    protected $dateFormat = 'Y-m-d H:i:sO';

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
        'nsfw' => 'false',
        'status' => 'Active'
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

    public const CATEGORY = [
        'Games', 'Software', 'E-Books', 'Skins', 'Music', 'Series & Movies', 'Comics & Manga', 'Others'
    ];

    public const CATEGORY_FORM = [
        'Games' => 'game',
        'Software' => 'sftw',
        'E-Books' => 'book',
        'Skins' => 'skin',
        'Music' => 'music',
        'Series & Movies' => 'sem',
        'Comics & Manga' => 'cem',
        'Others' => 'oth',
    ];

    public function getPrettyUrlAttribute() {
        return LbawUtils::slugify($this->title);
    }

    public function getEndedAttribute() {
        return Carbon::now() > $this->end_date;
    }

    public function getStartedAttribute() {
        return Carbon::now() > $this->start_date;
    }

    public function getScheduledAttribute() {
        return Carbon::now() < $this->start_date;
    }

    public function getOpenAttribute() {
        return $this->started && !$this->ended;
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

    public function getNBiddersAttribute() {
        return $this->bids->groupBy('bidder_id')->count();
    }

    public function getNBidsAttribute() {
        return $this->bids->count();
    }

    public function getHasBidsAttribute() {
        return $this->latest_bid != null;
    }

    public function holdsLatestBid($memberId) {
        return isset($this->latest_bid)
            && $memberId == $this->latest->bidder_id;
    }

    public function getOrderedBids() {
        return $this->bids()->orderBy('date', 'desc')->get();
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
        return $this->end_date->shortAbsoluteDiffForHumans();
    }

    public function getBidDataJson($bids): String {
        $ret = array();
        $ret['value'] = array();
        $ret['timestamp'] = array();

        foreach ($bids as $bid) {
            array_push($ret['value'], $bid->value);
            array_push($ret['timestamp'], $bid->date->timestamp);
        }

        return json_encode($ret);
    }
}
