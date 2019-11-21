<?php

namespace App\Http\Controllers;

use App\Support\Cart;
use App\Support\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = collect(Cart::getItems())->map(function($cartItem, $key){
            $product = Product::find($key);
            return [
                'product_id' => $key,
                'label' => $product['label'],
                'price' => $product['price'],
                'selected_quantity' => $cartItem,
                'stock' => $product['stock'],
                'image' => $product['image'],
            ];
        })->toArray();

        return view('cart')->with('cartItems', $cartItems);
    }

    public function addToCart($productId, Request $request)
    {
        if(!Product::exists($productId)){
            return response()->json("Failure. Something went wrong", 500);    
        }

        Cart::addItem($productId, $request);

        return response()->json(
            [
                'new_count_items' => Cart::getItemsCount(),
            ]
        );
    }

    public function removeFromCart($productId, Request $request)
    {
        if(!Cart::exists($productId)){
            return response()->json("Failure. Something went wrong", 500);    
        }

        Cart::removeItem($productId, $request);
        
        return response()->json(
            [
                'new_count_items' => Cart::getItemsCount(),
                'new_total_cost' => Cart::getItemsTotalCost(),
            ]
        );
    }

    public function updateItemQuantity($productId, Request $request)
    {   
        $newQuantity = (int) $request->input('new_selected_quantity', 1);
        
        if($newQuantity < 1){
            return response()->json('Something went wrong', 500);    
        }

        if(!Product::hasEnoughStock($productId, $newQuantity)){
            return response()->json('Not enough stock', 500);    
        }

        $request->session()->put('cart_items.' . $productId, $newQuantity);
        
        return response()->json(
            [
                'new_count_items' => Cart::getItemsCount(),
                'new_total_cost' => Cart::getItemsTotalCost(),
            ]
        );
    }
}
