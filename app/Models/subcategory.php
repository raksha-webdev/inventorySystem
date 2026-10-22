<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class subcategory extends Model
{
    protected $table='sub_category';
    public $fillable=['name','cat_id','status','added_date_time','created_at','updated_at'];
}
