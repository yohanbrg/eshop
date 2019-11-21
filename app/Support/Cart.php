<?php

namespace App\Support;

class Cart{

    public static function getItems()
    {
        $cartItems = session('cart_items', []);

        return $cartItems;
    }

    public static function getItemsCount()
    {
        return array_sum(self::getItems());
    }

    public static function getItemsTotalCost()
    {
        $itemsCost = collect(self::getItems())->map(function($item, $key){
            $product = Product::find($key);
            return $item * $product['price'];
        })->sum();
        
        return $itemsCost;
    }

    public static function addItem($itemId, $request)
    {
        $cartItems = Cart::getItems();
        $oldProductQuantity = isset($cartItems[$itemId]) ? $cartItems[$itemId] : 0;

        return $request->session()->put('cart_items.' . $itemId, $oldProductQuantity + 1);
    }

    public static function removeItem($itemId, $request)
    {
        return $request->session()->pull('cart_items.' . $itemId);
    }

    public static function exists($productId)
    {
        return array_key_exists($productId, self::getItems());
    }

}