<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model {
    use HasFactory;

    protected $table = 'bid';

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
        'date' => 'datetime',
    ];

    /**
     * Sets the format of datetimes in this model
     *
     * @var string
     */
    protected $dateFormat = 'Y-m-d H:i:sO';

    protected $fillable = [
        'value', 'bidder_id', 'auction_id'
    ];

    public function bidder() {
        return $this->hasOne(Member::class, "id", "bidder_id");
    }

}
