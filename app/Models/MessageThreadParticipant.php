<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageThreadParticipant extends Model {
    use HasFactory;

    protected $table = 'message_thread_participant';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        "thread_id", "participant_id"
    ];
}
