<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Rank;
use App\Models\User;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'rank_id',
        'user_id',
        'current_point',
        'date_start_rank',
    ];

    public $timestamps = false;

    public function rank()
    {
        return $this->belongsTo(Rank::class, 'rank_id', 'rank_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    public function addresses()
    {
        return $this->hasMany(Address::class, 'member_id', 'member_id');
    }
}