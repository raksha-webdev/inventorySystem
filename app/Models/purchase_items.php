<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class purchase_items extends Model
{
    protected $table = 'purchase_items';
    public $timestamps = true;
    public $fillable=[
        'purchase_id',
        'product_id',
        'quantity',
        'purchase_price',
        'subtotal'
    ];


    public function purchase()
{
    return $this->belongsTo(Purchase::class);
}

public function product()
{
    return $this->belongsTo(Product::class);
}


}
