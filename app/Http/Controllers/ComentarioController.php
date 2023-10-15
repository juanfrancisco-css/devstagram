<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    //

    public function store(Request $request ,User $user , Post $post)
    {
       // dd('enviando comentarios');

       //validar
        $this->validate($request,[
            'comentario'=>'required|max:255'
            
         ]);
/*
         $cometario = new Comentario; //se crear una nueva instancia de ese modelo
         $cometario->user_id = ;
         $cometario->post_id = ;
         $cometario->comentario = $request->comentario;
         $cometario->save();
        
 */

            Comentario::create([
                'user_id'=>auth()->user()->id ,
            'post_id'=>$post->id ,
                'comentario'=>$request->comentario
            ]);

            return back()->with('mensaje','Comentario publicado');
    }
}
