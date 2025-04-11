<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'max_price',
        'max_used',
        'sale_off',
        'date_start',
        'date_end',
    ];
    public $timestamps = false;
}
