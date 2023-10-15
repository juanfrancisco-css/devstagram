<?php

use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ComentarioController;

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
/*Route::get('/', function () {
    return view('welcome');
});



//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*****************************************Proyecto DevStagram ************************************ */
Livewire::component('like-post', LikePost::class);
//Livewire::component('like-post', [LikePost::class,'like']);

Route::get('/', HomeController::class)->name('home');

Route::get('/register', [RegisterController::class,'index'])->name('register') ;//cuando voy a visitar la pagina
Route::post('/register', [RegisterController::class,'store']);//toma por defecto la de arriba porque tiene la misma ruta que es crear cuenta

Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'store']);
Route::post('/logout',[LogoutController::class,'store'])->name('logout');

//rutas para el perfil
Route::get('/editar-perfil',[PerfilController::class,'index'])->name('perfil.index');
Route::post('/editar-perfil',[PerfilController::class,'store'])->name('perfil.store');
Route::get('/editar-perfil/modificar-password',[PerfilController::class,'create'])->name('perfil.create');
Route::post('/editar-perfil/modificar-password',[PerfilController::class,'create_store'])->name('perfil.create.store');

//Este metodo esta esperando una variable que se la pasaremos por parametros
Route::get('/{user:username}',[PostController::class,'index'])->name('posts.index');
Route::get('/posts/create',[PostController::class,'create'])->name('posts.create');
Route::post('/posts',[PostController::class,'store'])->name('posts.store');
//Aqui le pasaremos el id de esa foto selecionada
//espera una variabla
Route::get('/{user:username}/posts/{post}',[PostController::class,'show'])->name('posts.show');
Route::delete('/posts/{post}',[PostController::class,'destroy'])->name('posts.destroy');

Route::post('/{user:username}/posts/{post}',[ComentarioController::class,'store'])->name('comentarios.store');



Route::post('/imagenes',[ImagenController::class,'store'])->name('imagenes.store');


//Likes a las fotos
Route::post('/posts/{post}/likes',[LikeController::class,'store'])->name('posts.likes.store');
Route::delete('/posts/{post}/likes',[LikeController::class,'destroy'])->name('posts.likes.destroy');
//añadido ppor mi
Route::get('/posts/{post}/likes',[LikeController::class,'show'])->name('posts.likes.show');

//seguidores
Route::post('/{user:username}/follow',[FollowerController::class,'store'])->name('users.follow');
Route::delete('/{user:username}/unfollow',[FollowerController::class,'destroy'])->name('users.unfollow');
//añadido por mi
Route::get('/{user:username}/follow',[FollowerController::class,'show'])->name('users.follow.show');
Route::get('/{user:username}/following',[FollowerController::class,'show_following'])->name('users.following.show');














/****************** EJEMPLOS ***********************************/
Route::get('/nosotros', function () {
    return view('nosotros');
});

Route::get('/tienda', function () {
    return view('tienda');
});
/***************************FIN ***************************** */
