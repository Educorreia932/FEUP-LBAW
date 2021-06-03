<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Member extends Authenticatable implements MustVerifyEmail {
    use Notifiable;

    protected $table = 'member';

    protected $guard = 'member';

    public $timestamps  = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'joined' => 'datetime',
    ];

    /**
     * Sets the format of datetimes in this model
     *
     * @var string
     */
    protected $dateFormat = 'Y-m-d H:i:sO';

    protected $fillable = [
        'username', 'name', 'email', 'password', 'credit', 'bio'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    public static $default_bio = "This user hasn't developed a stand yet";

    public function getHasAuctionsAttribute() {
        return $this->createdAuctions()->count();
    }

    public function followsMember($id) {
        return $this->follows()->where('followed_id', '=', $id)->first() != null;
    }

    public function bookmarkedAuction($id) {
        return $this->bookmarkedAuctions()->where('auction_id', '=', $id)->first() != null;
    }

    public function getProfileAuctions() {
        $query = $this->createdAuctions()->orderBy('end_date', 'desc');

        if (!Auth::check() || !Auth::user()->nsfw_consent)
            $query = $query->where('nsfw', '=', 'FALSE');

        return $query->limit(8)->get();
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
            'follower_id',       // Foreign key on the follow table...
            'id',              // Foreign key on the member (to find) table...
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

    public function orderedThreads() {
        return $this->messageThreads()
            ->getQuery()
            ->select(DB::raw('message_thread.*, COALESCE(message.timestamp, message_thread.created) AS latest_activity'))
            ->leftJoin('message', 'message_thread.latest_message', '=', 'message.id')
            ->orderBy('latest_activity', 'desc');
    }

    public function messageThreads() {
        return $this->hasManyThrough(
            MessageThread::class,
            MessageThreadParticipant::class,
            'participant_id',
            'id',
            'id',
            'thread_id'
        );
    }

    public function notifications() {

    }

    public function getImage($type = 'small') {
        return asset('images/users/' . $this->id . '_' . $type . '.jpg');
    }

    public function getDefaultImage($type = 'small') {
        return asset('images/default/users/' . $type . '.jpg');
    }

    /**
     * Checks if a user has been rated by the authenticated user
     *
     * @param $id User's whose rating value is being checked
     * @return int User's given rating value by the authenticated user
     */
    public function ratedUser($id) {
        $user = Member::find($id);
        $rating = $user->ratings()->where("rater_id", "=", Auth::id())->first();

        if ($rating == null)
            return 0;

        return $rating->value;
    }

    public function ratings() {
        return $this->hasMany(
            Rating::class,
            "ratee_id",
            "id"
        );
    }
}
