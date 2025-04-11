<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bill;
use App\Models\ProductDetail;

class BillDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'bill_detail_id',
        'product_detail_id',
        'bill_id',
        'quantity',
        'price',
        'total_price',
        'price_discount',
        'rate_status'
    ];

    public $timestamps = false;

    public function bill()
    {
        return $this->belongsTo(Bill::class, 'bill_id', 'bill_id');
    }

    public function product_detail()
    {
        return $this->belongsTo(ProductDetail::class, 'product_detail_id', 'product_detail_id');
    }
}
