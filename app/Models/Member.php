<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable {
    use Notifiable;

    protected $table = 'member';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'joined' => 'datetime'
    ];

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', "remember_token"
    ];

    public function createdAuctions() {
        return $this->hasMany("App\Models\Auction", "seller_id");
    }

    public function bookmarkedAuctions() {
        return $this->hasMany("App\Models\BookmarkedAuction");
    }

    public function followers() {
        return $this->hasManyThrough(
            Member::class,
            Follow::class,
            "followed_id",
            "id",
            "id",
            "follower_id",
        );
    }

    public function notifications() {

    }
}
