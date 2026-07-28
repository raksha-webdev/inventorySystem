<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    protected $table='suppliers';
    public $fillable=[
        'supplier_name',
        'contact_person',
        'email',
        'phone',
        'gst_number',
        'address',
        'city',
        'state',
        'pin_code',
        'status',
        'supplier_code',
        'alternate_phone',
        'website',
        'notes'
    ];
}
