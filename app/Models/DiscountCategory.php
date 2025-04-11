<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rank;
use App\Models\Category;

class DiscountCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'discount_id',
        'percent_price',
        'rank_id',
        'category_id',
    ];

    public function rank()
    {
        return $this->belongsTo(Rank::class, 'rank_id', 'rank_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
}
