<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->request->add(['username' => Str::slug($request->input('username'))]);
        $this->validate($request,[
            'username'=> 'required|unique:users|min:3|max:20',
            'name'=>'required|max:30',
            'email'=>'required|unique:users|email|max:60',
            'password'=>'required|confirmed|min:6'
        ]);
        
        User::create([
            'name'=>$request->input('name'),
            'username'=>$request->input('username'),
            'email'=>$request->input('email'),
            'password'=>Hash::make($request->input('password')),
        ]);

       Auth()->attempt($request->only('email','password'));

        return redirect()->route('posts.index',['user'=>Auth()->user()]);
    }
}
