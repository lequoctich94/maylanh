<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $fillable = [
        'size_id',
        'category_id',
        'size_name'
    ];
    public $timestamps = false;
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
}
