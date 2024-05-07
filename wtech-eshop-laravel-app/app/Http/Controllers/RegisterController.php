<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $user = User::create([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'pword' => bcrypt($request->input('pword')),
            'user_group' => 'basic',
        ]);

        return redirect('/');
    }
}