<?php 

namespace App\Support;

class Product{

    public static function getAll()
    {
        return config('products');
    }

    public static function find($productId)
    {
        return config('products.' . $productId);
    }

    public static function exists($productId)
    {
        return array_key_exists($productId, self::getAll());
    }

    public static function hasEnoughStock($productId, $quantity)
    {
        $product = Product::find($productId);

        return $quantity <= $product['stock'] ?: false; 
    }

}