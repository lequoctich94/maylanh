<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Member;
use App\Models\Product;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = [
        'rate_id',
        'member_id',
        'product_id',
        'star',
        'comment',
        'date_rate',
    ];
    public $timestamps = false;

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'member_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
