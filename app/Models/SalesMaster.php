<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesMaster extends Model
{
    protected $table = 'sales_master';

    protected $fillable = [

        'customer_name',
        'customer_mobile_number',
        'customer_address',
        'purchase_date',
        'invoice_number',
        'sub_total',
        'discount',
        'grand_total',
        'status',

    ];


    public function saleProducts()
    {
        return $this->hasMany(
            SalesProductListMaster::class,
            'sale_id'
        );
    }



    public function customer()
{
    return $this->belongsTo(Customer::class, 'customer_id');
}


}



