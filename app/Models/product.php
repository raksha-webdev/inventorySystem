<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table = 'product';
    protected $fillable = [
        'category_id',
        'supplier_id',
        'product_name',
        'sku',
        'barcode',
        'description',
        'purchase_price',
        'selling_price',
        'stock_quantity',
        'minimum_stock',
        'unit',
        'product_image',
        'status',
    ];

    public function purchaseItems()
{
    return $this->hasMany(purchase_items::class);
}


}
