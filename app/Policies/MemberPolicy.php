<?php

namespace App\Policies;

use App\Models\Member;
use App\Models\Auction;

use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class MemberPolicy {
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Member  $member
     * @return mixed
     */
    public function update(Member $member) {
        return Auth::id() === $member->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Member  $member
     * @return mixed
     */
    public function delete(Member $member) {
        return Auth::id() === $member->id;
    }
}
