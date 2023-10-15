<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //

    public function store(Request $request , Post $post)
    {

        //dd('dando like al post ' . $post->id);
//quien va a tener la accion
//accedo a la relacion q tengo para crear
        $post->likes()->create([
               'user_id'=>$request->user()->id
        ]);

        return back();
    }

    public function destroy( Request $request , Post $post)
    {

       // dd('eliminando like');
       //el usuario auntenticado que tiene el method post 
       //donde esta el post que yo le he dado lo eliminamos

//accedo a la relacion 
//si accedo a la relacion me traera toda si informacion
//quien va a tener la accion
//acceder al methodo likes()
//acceder a la informacion , traernos la informacion like
       $request->user()->likes()->where('post_id',$post->id)->delete();
//puedo usar request pues accedo a travez de un formulario
       return back();

    }

    //añadido
    public function show(Request $request , Post $post){


      
        /*
        foreach( $post->likes as $like){

           dd( $like->user->username);
        }
        */
       // dd($post->likes);

       return view('like',[
        'post'=>$post
      ]);
       
    }
}
