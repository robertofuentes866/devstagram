<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(Request $request, User $user,Post $post)
    {
        $this->validate($request,[
            'comentario'=>'required|max:255',
        ]);

        $comentario = new Comentario();
        $comentario->post_id = $post->id;
        $comentario->user_id = auth()->user()->id;
        $comentario->comentario = $request->input('comentario');
        $comentario->save();

        return back()->with('mensaje','Comentario guardado!') ;
    }
}
