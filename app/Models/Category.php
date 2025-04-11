<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    use HasFactory;

    // protected $primaryKey = 'category_id';

    protected $fillable = [
        'category_id',
        'category_name',
        'suffix_img'
    ];

    // public $timestamps = false;

    public function products()
    {
        //Tham số thứ 2 - lấy category_id từ class tham chiếu (Product) - foreign key
        //Tham số thứ 3- lấy category_id từ class chính (Category) - local key
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }
}
