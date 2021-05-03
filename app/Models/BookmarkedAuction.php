<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookmarkedAuction extends Model {
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'auction_id', 'member_id'
    ];

    protected $table = 'bookmarked_auction';

}
