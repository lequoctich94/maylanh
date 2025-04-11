<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Member;
use App\Models\ProductDetail;

class Favourite extends Model
{
    use HasFactory;
    protected $fillable = [
        'favourite_id',
        'member_id',
        'product_detail_id',
    ];
    public $timestamps = false;
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'member_id');
    }
    public function product_detail()
    {
        return $this->belongsTo(ProductDetail::class, 'product_detail_id', 'product_detail_id');
    }
}
