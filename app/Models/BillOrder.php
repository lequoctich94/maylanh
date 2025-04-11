<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stock;
use App\Models\User;
use App\Models\Producer;

class BillOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'bill_order_id',
        'amount',
        'total_price',
        'stock_id',
        'date_order',
        'producer_id',
        'user_id',
    ];

    public $timestamps = false;

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id', 'stock_id');
    }

    public function producer()
    {
        return $this->belongsTo(Producer::class, 'producer_id', 'producer_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
