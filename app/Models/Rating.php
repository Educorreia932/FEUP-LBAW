<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model {
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        "value", "rater_id", "ratee_id"
    ];

    public $incrementing = false;

    protected $table = 'rating';
}
