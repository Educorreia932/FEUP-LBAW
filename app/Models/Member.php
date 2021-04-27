<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model {
    use HasFactory;

    protected $table = 'member';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'joined' => 'datetime'
    ];

    public function createdAuctions() {
        return $this->hasMany( "App\Models\Auction", "seller_id");
    }

    public function bookmarkedAuctions() {
        return $this->hasManyThrough(
            Auction::class,
            BookmarkedAuction::class,
            'auction_id', // Foreign key on the bookmarks table...
            'id', // Foreign key on the auction table...
            'id', // Local key on the member table...
            'member_id' // Local key on the bookmarks table...
        );
    }

    public function follows() {
        return $this->hasManyThrough(
            Member::class,
            Follow::class,
            'follower_id', // Foreign key on the follow table...
            'id', // Foreign key on the member (to find) table...
            'id', // Local key on the member (own) table...
            'followed_id' // Local key on the follow table...
        );
    }

    public function followedBy() {
        return $this->hasManyThrough(
            Member::class,
            Follow::class,
            'followed_id', // Foreign key on the follow table...
            'id', // Foreign key on the member (to find) table...
            'id', // Local key on the member (own) table...
            'follower_id' // Local key on the follow table...
        );
    }

    public function notifications() {

    }
}
