<?php

namespace App\Helper;

class ProductDetailHelper
{
    public static function createProductDetailId($product_id, $param)
    {
        $id = $product_id;
        if(isset($param['size_id'])){
            $id .= '_' . $param['size_id'];
        }
        if(isset($param['color_id'])){
            $id .= '_' . $param['color_id'];
        }
        // if(isset($param['price_produced'])){
        //     $id .= '_' . $param['price_produced'];
        // }
        return $id;
    }

}