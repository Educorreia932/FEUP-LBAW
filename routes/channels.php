<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('message_thread', function ($user) {
    return $user;
});
