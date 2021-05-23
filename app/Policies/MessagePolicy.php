<?php

namespace App\Policies;

use App\Models\Member;
use App\Models\MessageThread;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class MessagePolicy {
    use HandlesAuthorization;


}
