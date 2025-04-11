<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ProductDetail;
use App\Models\Member;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_detail_id',
        'member_id',
        'quantity',
        'price_pay'
    ];

    public $timestamps = false;
    public function product_detail()
    {
        return $this->belongsTo(ProductDetail::class, 'product_detail_id', 'product_detail_id');
    }
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'member_id');
    }
}
