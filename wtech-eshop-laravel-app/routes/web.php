<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Log;

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


Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');



use App\Filters\ProductFilters;

Route::get('/category/{category}', function ($category, ProductFilters $filters) {
    $query = App\Models\Product::where('category', $category);

    $products = $filters->apply($query, request())->orderBy('price', request('cena', 'asc'))->paginate(12);

    $brands = App\Models\Product::where('category', $category)->select('brand')->distinct()->get();

    return view('category', ['products' => $products, 'brands'=>$brands, 'category' => $category]);
})->name('category');


Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [RegisterController::class, 'store']);

Route::post('/logout', [RegisterController::class, 'logout'])->name('logout');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [RegisterController::class, 'login']);

Route::post('/add_to_cart', function () {
    $product_id = request('product_id');
    $quantity = request('quantity');

    $cart = session()->get('cart', []);


    if(isset($cart[$product_id])) {
        $cart[$product_id]['quantity'] += $quantity;
    } else {
        $cart[$product_id] = [
            'quantity' => $quantity,
        ];
    }


    session()->put('cart', $cart);


    $user_id = session('id');
    Log::info('User ID: ' . $user_id);
    if ($user_id) {
        $db_cart = App\Models\shopping_cart::where('user_id', $user_id)->where('product_id', $product_id)->first();
        if ($db_cart) {
            $db_cart->quantity += $quantity;
            $db_cart->save();
        } else {
            App\Models\shopping_cart::create(['user_id' => $user_id, 'product_id' => $product_id, 'quantity' => $quantity]);
        }
    }

    return redirect()->back();
})->name('add_to_cart');


Route::get('/cart', function () {
    $cart = session()->get('cart', []);
    $products = App\Models\Product::whereIn('id', array_keys($cart))->get();
    return view('cart', ['products' => $products, 'cart' => $cart]);
})->name('cart');