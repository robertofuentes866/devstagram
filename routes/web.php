<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',HomeController::class)->name('home');

Route::get('/crear-cuenta', [RegisterController::class,'index'])->name('crearCuenta');
Route::post('/crear-cuenta',[RegisterController::class,'store']);

// Edicion del perfil del usuario.
Route::get('/editar-perfil',[PerfilController::class,'index'])->name('perfil.index');
Route::post('/editar-perfil',[PerfilController::class,'store'])->name('perfil.store');

Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'store']);

Route::post('/logout',[LoginController::class,'logout'])->name('logout');
Route::get('/{user:username}',[PostController::class,'index'])->name('posts.index');
Route::get('/posts/create',[PostController::class,'create'])->name('posts.create');

Route::post('/posts',[PostController::class,'store'])->name('posts.store');

Route::post('/imagenes',[ImagenController::class,'store'])->name('imagenes.store');

Route::get('/{user:username}/posts/{post}',[PostController::class,'show'])->name('posts.show');

Route::post('/{user:username}/posts/{post}',[ComentarioController::class,'store'])->name('comentarios.store');

Route::delete('/posts/{post}',[PostController::class,'destroy'])->name('posts.destroy');

// Like a las fotos.
//Route::post('/posts/{post}/likes',[LikeController::class,'store'])->name('posts.likes.store');

// Followers.

Route::post('/{user:username}/follower',[FollowerController::class,'store'])->name('users.follower');
Route::delete('/{user:username}/unfollower',[FollowerController::class,'destroy'])->name('users.unfollower');



