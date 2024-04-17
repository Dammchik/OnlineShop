<?php

use Illuminate\Support\Facades\Route;

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
//Route::middleware('auth')->group(function (){
    Route::resource('products', "\App\Http\Controllers\ProductController");
//});

/*Route::get ('/product/{product}', 'App\Http\Controllers\ProductController@show')->where('id', '[0-9]+')
    ->name('product.show');*/
Route::post('cartAdd', 'App\Http\Controllers\CartController@addProduct')
    ->name('cart.add');

Route::get('/cart', 'App\Http\Controllers\CartController@cart')->name('cart.content');

Route::post('/cartDelete','App\Http\Controllers\CartController@removeProduct')
    ->name('cart.delete');

Route::post('/cartClear','App\Http\Controllers\CartController@clearCart')
    ->name('cart.clear');

Route::post('/makeOrder','App\Http\Controllers\CartController@makeOrder')
    ->name('cart.makeOrder');

Route::resource('orders', "\App\Http\Controllers\OrderController");

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
