<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth')->except(['show','index']);
    }

    public function index(User $user)
    {
        // Extraer los posts de este usuario.

        $posts = Post::where('user_id',$user->id)->latest()->paginate(10);

       return view('layouts.dashboard',['user'=> $user,
                                          'posts'=>$posts]);
    }

    public function create()
    {
      return view('posts.create');
    }

    public function store(Request $request)
    {
       $this->validate($request,[
            'titulo'=> 'required|max:255',
            'descripcion' => 'required',
            'imagen'=> 'required',
       ]);

       $request->user()->posts()->create([
         'titulo' => $request->titulo,
         'descripcion' => $request->descripcion,
         'imagen'=> $request->imagen,
       ]);

       return redirect()->route('posts.index',auth()->user()->username);
    }

    public function show(User $user,Post $post)
    {
      $fill_like = "white";
      if ($post->checkLike(auth()->user()))
      {
        $fill_like = "blue";
      }
      $like_counter = $post->countLike();
      return view('posts.show',["post"=>$post,'user'=>$user,'fill_like'=>$fill_like,'like_counter'=>$like_counter]);
    }

    public function destroy(Post $post)
    {
      $this->authorize('delete',$post);
      $post->delete();
      $file = public_path('uploads/'). $post->imagen;
      unlink($file);
      return redirect()->route('posts.index',auth()->user()->username);
    }
}
