<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuctionReport extends Model {
    use HasFactory;

    public $timestamps  = false;

    protected $fillable = [
        "reason", 'description', 'reporter_id', 'reported_id'
    ];

    protected $table = 'auction_report';
}
