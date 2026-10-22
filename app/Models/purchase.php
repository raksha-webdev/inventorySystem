<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class purchase extends Model
{
    protected $table = 'purchase';
    public $fillable=[
        'supplier_id',
        'invoice_number',   
        'purchase_date',
        'subtotal',
        'tax_percent',
        'tax_amount',
        'discount',
        'shipping_charge',
        'grand_total',
        'paid_amount',
        'due_amount',
        'payment_method',
        'payment_status',
        'remarks',
    ];

    
public function supplier()
{
    return $this->belongsTo(Supplier::class, 'supplier_id');

}

// Purchase has many Purchase Items
public function items()
{
    return $this->hasMany(purchase_items::class, 'purchase_id');
}
}
