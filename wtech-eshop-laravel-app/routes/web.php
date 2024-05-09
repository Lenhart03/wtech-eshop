<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

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
use App\Http\Controllers\PaymentController;

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

    $product_index = array_search($product_id, array_column($cart, 'product_id'));

    if ($product_index !== false) {
        $cart[$product_index]['quantity'] += $quantity;
    } else {
        $cart[] = [
            'product_id' => $product_id,
            'quantity' => $quantity,
        ];
    }

    session()->put('cart', $cart);


    session()->put('cart', $cart);


    $user_id = session('id');
    Log::info('User ID: ' . $user_id);
    if ($user_id) {
        $db_cart = App\Models\shopping_cart::where('user_id', $user_id)->where('product_id', $product_id)->first();
        if ($db_cart) {
            App\Models\shopping_cart::where('user_id', $user_id)
                ->where('product_id', $product_id)
                ->update(['quantity' => $db_cart->quantity + $quantity]);
        } else {
            App\Models\shopping_cart::create(['user_id' => $user_id, 'product_id' => $product_id, 'quantity' => $quantity]);
        }
    }
    return redirect()->back();
})->name('add_to_cart');



Route::get('/cart', function () {
    $cart = session()->get('cart', []);
    $products = [];
    foreach ($cart as $item) {
        $productId = $item['product_id'];
        $product = App\Models\Product::find($productId);

        $products[] = ['product'=>$product,'quantity'=>$item['quantity']];
    }

    return view('cart', ['products' => $products]);
})->name('cart');

Route::post('/update_cart', function () {
    $product_id = request('product_id');
    $quantity = request('quantity');

    $cart = session()->get('cart', []);

    $product_index = array_search($product_id, array_column($cart, 'product_id'));

    if ($product_index !== false and $quantity > 0) {
        $cart[$product_index]['quantity'] = $quantity;
    } elseif ($product_index !== false and $quantity == 0) {
        unset($cart[$product_index]);
    }

    session()->put('cart', $cart);

    $user_id = session('id');
    if ($user_id and $quantity > 0) {
        App\Models\shopping_cart::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->update(['quantity' => $quantity]);
    }elseif ($user_id and $quantity == 0) {
        App\Models\shopping_cart::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->delete();
    }

    return redirect()->back();
})->name('update_cart');


Route::get('/order', function () {
    return view('order');
});


Route::post('/order/payment', [PaymentController::class, 'payment']);

Route::post('payment/confirmation', [PaymentController::class,'store']);

Route::get('/order/confirmation', function () {
    return view('confirmation');
});

