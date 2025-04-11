<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BillOrder;
use App\Models\ProductDetail;

class BillOrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'bill_order_detail_id',
        'product_detail_id',
        'bill_order_id',
        'quantity',
        'price_order',
        'total_price',
        'price_pay',
    ];

    public $timestamps = false;

    public function product_detail()
    {
        return $this->belongsTo(ProductDetail::class, 'product_detail_id', 'product_detail_id');
    }

    public function bill_order()
    {
        return $this->belongsTo(BillOrder::class, 'bill_order_id', 'bill_order_id');
    }
}