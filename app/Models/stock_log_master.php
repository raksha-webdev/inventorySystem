<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class stock_log_master extends Model
{
    protected $table = 'stock_log_master';

    protected $fillable = [
        'product_id',
        'transaction_type',
        'quantity',
        'reason',
        'transaction_date',
        'status',
    ];


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    
}
