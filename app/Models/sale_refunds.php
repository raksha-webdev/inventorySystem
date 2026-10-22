<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sale_refunds extends Model
{
    protected $table = 'sale_refunds';
    public $timestamps = true;
    protected $fillable = [
        'sale_id',
        'refund_amount',
        'refund_method',
        'refund_status',
        'transaction_reference',
        'refund_reason',
        'processed_at',
    ];
}
