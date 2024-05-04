<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', function () {
    $products = App\Models\Product::with('images')->paginate(19);
    return view('mainpage', ['products' => $products]);
});

Route::get('/detail/{id}', function ($id) {
    $product = App\Models\Product::with('images','parameters')->find($id);
    return view('detail', ['product' => $product]);
})->name('detail');
