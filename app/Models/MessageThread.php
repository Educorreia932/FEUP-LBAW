<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MessageThread extends Model {
    use HasFactory;

    protected $table = 'message_thread';

    public $timestamps = false;

    public function messages() {
        return $this->hasMany(Message::class, "thread_id")->orderBy('timestamp');
    }

    public function getOtherParticipantsAttribute() {
        return $this->participants()->where("participant_id", "<>", Auth::id())->get();
    }

    public function participants() {
        return $this->hasManyThrough(
            Member::class,
            MessageThreadParticipant::class,
            "thread_id",
            "id",
            "id",
            "participant_id"
        );
    }

    public function title() {
        $topic = $this->participants[0]->name;

        for ($i = 1; $i < $this->participants->count() - 1; $i++)
            $topic .= ", " . $this->participants[$i]->name;

        $topic .= " and " . $this->participants[$this->participants()->count() - 1]->name;

        return $topic;
    }

    public function addParticipant($participant_id) {
        MessageThreadParticipant::create([
            "thread_id" => $this->id,
            "participant_id" => $participant_id
        ]);
    }
}
