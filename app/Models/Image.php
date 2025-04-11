<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $primaryKey = 'img_id';

    public $incrementing = false;

    protected $fillable = [
        'img_id',
        'img_name',
        'product_id',
        'color_id',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id', 'color_id');
    }
}
