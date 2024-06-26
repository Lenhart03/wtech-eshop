<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function payment(Request $request){
        $cart = session()->get('cart', []);
        $products = [];
        foreach ($cart as $item) {
            $productId = $item['product_id'];
            $product = Product::find($productId);

            $products[] = ['product'=>$product,'quantity'=>$item['quantity']];
        }

        //dd($request,$products,Auth::id());

        return view('/payment',['products'=>$products, 'request'=>$request]);
    }
    public function store(Request $request){
        $cart = session()->get('cart', []);
        $user_id = Auth::id();


        $order = Order::create([
            'user_id' => $user_id,
            'time_ordered'=> now(),
            'state' => 'new',
            'firstname' => $request->meno,
            'lastname' => $request->priezvisko,
            'transport_type' => $request->sposob_dopravy,
            'street_name' => $request->ulica,
            'zip_code' => $request->psc,
            'phone_number' => $request->telefon,
            'payment'=> $request->sposob_platby,
        ]);

        foreach ($cart as $item) {
            $productId = $item['product_id'];
            $product = Product::find($productId);


            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'count' => $item['quantity'],

            ]);
        }

        ShoppingCart::where('user_id', $user_id)->delete();

        session()->put('cart', []);

        return redirect('/order/confirmation');
    }
}
