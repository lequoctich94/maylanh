<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Rank extends Model
{
    use HasFactory;

    protected $fillable = [
        'rank_id',
        'rank_name',
        'point',
    ];

    public function discount_categories()
    {
        return $this->hasMany(DiscountCategory::class, 'rank_id', 'rank_id');
    }
}