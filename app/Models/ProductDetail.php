<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;
use App\Models\Size;
use App\Models\Color;

class ProductDetail extends Model
{
    use HasFactory;
    //protected $table = 'product_details';
    //protected $primaryKey = 'product_detail_id';

    protected $fillable = [
        'product_detail_id',
        'product_id',
        'size_id',
        'status',
        'color_id',
        'price_produced',
        'power',
        'power_unit',
        'price_produced_for_sale'
    ];
    public $timestamps = false;
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id', 'size_id');
    }
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id', 'color_id');
    }
}
