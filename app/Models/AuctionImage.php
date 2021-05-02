<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuctionImage extends Model {
    use HasFactory;

    protected $table = 'auction_image';

    public $timestamps = false;

    protected $fillable = [
        'auction_id'
    ];
}
