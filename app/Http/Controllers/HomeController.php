<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function __invoke()
    {
        $ids = auth()->user()->following->pluck('id')->toArray(); // usuarios a quien estoy siguiendo...
        $posts = Post::whereIn('user_id',$ids)->latest()->paginate(10);  // post de los que estoy siguiendo...
        return view('home',compact('posts'));
    }
}
