<?php

namespace App\Policies;

use App\Models\Member;

use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class MemberPolicy {
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Member  $member
     * @param  \App\Models\Member  $target
     * @return mixed
     */
    public function update(Member $member, Member $target) {
        return $member->id === $target->id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Member  $member
     * @param  \App\Models\Member  $target
     * @return mixed
     */
    public function change_password(Member $member, Member $target) {
        return $member->id === $target->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Member  $member
     * @param  \App\Models\Member  $target
     * @return mixed
     */
    public function delete(Member $member, Member $target) {
        return $member->id === $target->id;
    }
}
