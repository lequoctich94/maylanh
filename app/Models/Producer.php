<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
   use HasFactory;
   protected $fillable = [
      'producer_id',
      'producer_name',
      'phone',
      'address',
      'status'
   ];
   public $timestamps = false;
}
