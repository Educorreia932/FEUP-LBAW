<?php

namespace App\Policies;

use App\Models\Member;
use App\Models\Auction;

use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class MemberPolicy {
    use HandlesAuthorization;

    /**
     * Determine whether the user can edit another
     *
     * @param Member $member
     * @param Member $target
     * @return mixed
     */
    public function edit(Member $member, Member $target) {
        return $member->id == $target->id;
    }

    /**
     * Determine whether the user can report another
     *
     * @param Member $member
     * @param Member $target
     * @return mixed
     */
    public function report(Member $member, Member $target) {
        return $member->id != $target->id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param Member $member
     * @return mixed
     */
    public function update(Member $member) {
        return Auth::id() === $member->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param Member $member
     * @return mixed
     */
    public function delete(Member $member) {
        return Auth::id() === $member->id;
    }

    /**
     * Determine whether the user can rate another.
     *
     * @param Member $member
     * @param Member $target
     * @return bool
     */
    public function rate(Member $member, Member $target) {
        return $member->id != $target->id;
    }
}
