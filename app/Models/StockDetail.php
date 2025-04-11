<?php

namespace App\Models;

use App\Models\Stock;
use App\Models\ProductDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'stock_detail_id',
        'stock_id',
        'product_detail_id',
        'price_pay',
        'quantity',
        'sale_off',
        'total_price',
    ];
    public $timestamps = false;
    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id', 'stock_id');
    }
    public function product_detail()
    {
        return $this->belongsTo(ProductDetail::class, 'product_detail_id', 'product_detail_id');
    }
}
