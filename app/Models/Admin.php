<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable {
    use Notifiable;
    

    protected $table = 'admin';

    protected $guard = 'admin';

    public $timestamps = false;

    protected $fillable = [
        'username', 'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function getImage($type='small') {
        return asset('images/users/' . $this->id . '_' . $type . '.jpg');
    }
    
}
