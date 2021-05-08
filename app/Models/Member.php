<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable {
    use Notifiable;

    protected $table = 'member';

    public $timestamps = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'joined' => 'datetime'
    ];

    protected $fillable = [
        "username", 'name', 'email', 'password', "credit"
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    public function getHasAuctionsAttribute() {
        return $this->createdAuctions()->count();
    }

    public function followsMember($id) {
        return $this->follows()->where('followed_id', '=', $id)->first() != null;
    }

    public function bookmarkedAuction($id) {
        return $this->bookmarkedAuctions()->where('auction_id', '=', $id)->first() != null;
    }

    public function createdAuctions() {
        return $this->hasMany("App\Models\Auction", "seller_id");
    }

    public function bookmarkedAuctions() {
        return $this->hasManyThrough(
            Auction::class,
            BookmarkedAuction::class,
            'member_id',      // Foreign key on the bookmarks table...
            'id',            // Foreign key on the auction table...
            'id',             // Local key on the member table...
            'auction_id'  // Local key on the bookmarks table...
        );
    }

    public function follows() {
        return $this->hasManyThrough(
            Member::class,
            Follow::class,
            'follower_id',      // Foreign key on the follow table...
            'id',             // Foreign key on the member (to find) table...
            'id',               // Local key on the member (own) table...
            'followed_id'  // Local key on the follow table...
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

    public function messageThreads() {
        return $this->hasManyThrough(
            MessageThread::class,
            MessageThreadParticipant::class,
            'thread_id',
            'id',
            'id',
            'participant_id'
        );
    }

    public function notifications() {

    }

    public function getImage($type = 'small') {
        return asset('images/users/' . $this->id . '_' . $type . '.jpg');
    }
}
