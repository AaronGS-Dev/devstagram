<?php

use App\Http\Controllers\Auth\CommentController;
use App\Http\Controllers\Auth\FollowerController;
use App\Http\Controllers\Auth\HomeController;
use App\Http\Controllers\Auth\ImagenController;
use App\Http\Controllers\Auth\LikeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\PostController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//No necesitamos el 'index' no los [] por que estamos usando el metodo invoke en el controlador(lo usamos por que el controlador solo va a tener un metodo)
Route::get('/', HomeController::class)->name('home');


Route::get('/create-account',[RegisterController::class, 'index'])->name('create-account');
Route::post('/create-account',[RegisterController::class, 'store']);

Route::get('/login',[LoginController::class, 'index'])->name('login');
Route::post('/login',[LoginController::class, 'store']);
Route::post('/logout',[LogoutController::class, 'store'])->name('logout');

//Rutas para el perfil
Route::get('/edit-profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/edit-profile', [ProfileController::class, 'store'])->name('profile.store');


Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::post('/{user:username}/posts/{post}',[CommentController::class, 'store'])->name('comments.store');


Route::post('/imagen', [ImagenController::class, 'store'])->name('imagenes.store');

//Like a las fotos
Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('post.likes.store');
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('post.likes.destroy');

Route::get('/{user:username}',[PostController::class, 'index'])->name('post.index');

//Siguiendo a usuarios
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');

