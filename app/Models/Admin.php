<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable

{
    use Notifiable;

    protected $table = '_admin';

    protected $fillable = [
        'mobile_number',
        'email',
        'full_name',
        'password',
        'user_type',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }
}
