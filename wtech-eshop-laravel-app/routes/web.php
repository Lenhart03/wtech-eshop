<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


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




Route::get('/search', function () {
    $keyword = '%' . strtolower(request('key')) . '%';
    $products = App\Models\Product::whereRaw('LOWER(name) LIKE ?', [$keyword])
                            ->orWhereRaw('LOWER(description) LIKE ?', [$keyword])
                            ->orWhereRaw('LOWER(brand) LIKE ?', [$keyword])
                            ->orWhereRaw('LOWER(category) LIKE ?', [$keyword])
                            ->paginate(10);
    return view('search', ['products' => $products, 'keyword' => request('key')]);
})->name('search');



