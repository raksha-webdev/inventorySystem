<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FirebaseDeviceToken extends Model
{
    protected $table = 'firebase_device_tokens';

    protected $fillable = [
        'user_id',
        'user_type',
        'fcm_token',
        'device_type',
    ];
}
