<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class PerfilController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(User $user)
    {
        return view('perfil.index',$user);
    }

    public function store(Request $request)
    {
        $request->request->add(['username' => Str::slug($request->input('username'))]);
       $this->validate($request,[
        'username'=> ['required','unique:users,username,'.auth()->user()->id,'min:3','max:20'],
       ]);

       $usuario = User::find(Auth()->user()->id);
       $usuario->username = $request->username;
       if ($request->file('imagen'))
       {
        $usuario->imagen = $this->fitImage($request,'imagen','perfiles',1000);
       }
       
       $usuario->save();

       return redirect()->route('posts.index',$usuario->username);
       
    }
}
