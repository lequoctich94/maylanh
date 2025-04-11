<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Member;
use App\Models\Voucher;

class VoucherMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'member_id',
        'code',
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
