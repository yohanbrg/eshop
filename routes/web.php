<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    return view('products')->with('products', \App\Support\Product::getAll());
})->name('products');

Route::get('/cart', 'CartController@index')->name('cart');
Route::post('/addtocart/{productId}', 'CartController@addToCart')->name('addToCart');
Route::post('/remove-from-cart/{productId}', 'CartController@removeFromCart')->name('removeFromCart');
Route::post('/update-item-quantity/{productId}', 'CartController@updateItemQuantity')->name('updateItemQuantity');
