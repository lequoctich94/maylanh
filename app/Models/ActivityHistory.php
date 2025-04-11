<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ActivityHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity',
        'object_id',
        'date_created',
        'user_id',
        'type',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
