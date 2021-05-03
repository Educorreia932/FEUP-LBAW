<?php

namespace App\Policies;

use App\Models\Member;

use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class MemberPolicy {
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Member  $member
     * @return mixed
     */
    /*public function viewAny(Member $member) {
        //
    }*/

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Member  $member
     * @param  \App\Models\Member  $member
     * @return mixed
     */
    /*public function view(Member $member, Member $member) {
        //
    }*/

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Member  $member
     * @return mixed
     */
    /*public function create(Member $member) {
        //
    }*/

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

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Member  $member
     * @param  \App\Models\Member  $member
     * @return mixed
     */
    /*public function restore(Member $member, Member $member) {
        
    }*/

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Member  $member
     * @param  \App\Models\Member  $member
     * @return mixed
     */
    /*public function forceDelete(Member $member, Member $member) {
        
    }*/
}
