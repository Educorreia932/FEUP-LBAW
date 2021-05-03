<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class follow extends Model {
    use HasFactory;

    public $timestamp = false;

    protected $fillable = [
        'follower_id', 'followed_id'
    ];

    protected $table = 'follow';
}
