<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table = 'category';
    protected $fillable = [
        'cat_name',
        'cat_img',
        'status',
    ];
}
