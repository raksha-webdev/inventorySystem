<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesProductListMaster extends Model
{
    protected $table = 'sales_product_list_master';

    protected $fillable = [

        'sale_id',
        'product_id',
        'quantity',
        'cost',
        'tax',
        'total',
        'status',

    ];


    public function sale()
    {
        return $this->belongsTo(
            SalesMaster::class,
            'sale_id'
        );
    }


    public function product()
    {
        return $this->belongsTo(
            Product::class,
            'product_id'
        );
    }

    


}
