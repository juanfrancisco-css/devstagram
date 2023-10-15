<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
   
    public function __construct()
    {
        //para acceder a la pagina principal debe de estar autenticado 
        //si no te regresaran al login
        //proteger las rutas
        $this->middleware('auth');
    }
    
    public function __invoke()
    {
       //dd('home');

       //quienes seguimos  requerimos solo su id
       //del usuario autenticado los que el sigue
       // dd(auth()->user()->followings->pluck('id')->toArray());
      $ids= auth()->user()->followings->pluck('id')->toArray();
      //utilizo whereIn porque estoy trabahjando con arrays ademas no tengo idea ni le estoy dando un valor especifico
      //si no un cojunto de valores q me filtrara y con paginate o con get() me los devuelve
      $posts=Post::whereIn('user_id',$ids)->latest()->paginate(20);
      //dd($posts);
       return view('home',[
        'posts'=>$posts,
       ]);
    }
}
