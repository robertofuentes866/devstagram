<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'email' =>'required|email',
            'password' => 'required',
        ]);

        if (Auth()->attempt($request->only(['email','password']),$request->remember))
        {
           return redirect()->route('posts.index',Auth()->user());
        } else
        {
            return back()->with('mensaje','Credenciales incorrectas, intente nuevamente');
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
