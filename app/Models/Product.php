<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Category;
use App\Models\Producer;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'product_name',
        'category_id',
        'producer_id',
        'product_img',
        'description',
    ];

    protected function fullTextWildcards($term)
    {
        // removing symbols used by MySQL
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $term = str_replace($reservedSymbols, '', $term);

        $words = explode(' ', $term); //same split

        foreach ($words as $key => $word) {
            /*
            * applying + operator (required word) only big words
            * because smaller ones are not indexed by mysql
            */
            if (strlen($word) >= 1) { //Get length text
                $words[$key] = '+' . $word  . '*';
            }
        }

        $searchTerm = implode(' ', $words);

        return $searchTerm;
    }

    //Search with product  name
    public function scopeFullTextSearch($query, $term)
    {
        $query->whereRaw("MATCH (product_name) AGAINST (? IN BOOLEAN MODE)", $this->fullTextWildcards($term));

        return $query;
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
    public function producer()
    {
        return $this->belongsTo(Producer::class, 'producer_id', 'producer_id');
    }
    public function images()
    {
        return $this->hasMany(Image::class, 'product_id', 'product_id');
    }
    public function product_detail()
    {
        return $this->hasMany(ProductDetail::class, 'product_id', 'product_id');
    }
}
