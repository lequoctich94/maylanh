<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Member;
use App\Models\Voucher;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'bill_id',
        'member_id',
        'shipping_address',
        'shipping_phone',
        'receiver',
        'code',
        'date_order',
        'total_price',
        'total_quantity',
        'payment',
    ];

    public $timestamps = false;

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'member_id');
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class, 'code', 'code');
    }
}