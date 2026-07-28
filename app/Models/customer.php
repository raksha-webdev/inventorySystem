<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    protected $table='customers';
    public $fillable=[
        'customer_name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'pin_code',
        'is_deleted',
    ];
}
