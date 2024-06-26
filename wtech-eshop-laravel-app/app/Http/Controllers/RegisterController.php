<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ShoppingCart;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|min:3',
            'lastname' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:5',
        ]);

        $user = User::create([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'User logged out');
    }


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            session(['id' => auth()->id()]);

            $cartItems = ShoppingCart::where('user_id', auth()->id())->get();
            if (!$cartItems->isEmpty()) {
                $cart = [];
                foreach ($cartItems as $item) {
                    $cart[] = ['product_id' => $item->product_id, 'quantity' => $item->quantity];
                }
                session(['cart' => $cart]);
            } else {
                session(['cart' => []]);
            }

            if (auth()->user()['user_group'] == 'admin')
                return redirect('/admin');

            return redirect('/')->with('message', 'User logged in');
        } else {
            return redirect('/login')->with('error', 'Invalid credentials');
        }
    }
}
