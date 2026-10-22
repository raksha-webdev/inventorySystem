<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class brandmaster extends Model
{
    protected $table = 'brand_master';
    protected $fillable = ['name', 'status', 'added_date_time'];
    public $timestamps = false;
}
