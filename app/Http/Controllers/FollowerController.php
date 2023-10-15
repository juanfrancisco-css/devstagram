<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    //

    public function store(Request $request , User $user)
    {

       // dd("Seguir a " . $user->username ." -".auth()->user()->username." -". $request->username);
           //dd("Seguir a " . $user->username);
//acceder al methodo
//para relacionar la  misma tabla usamos attach() no nos sirve create
//almacenar el usuario autenticado 
           $user->followers()->attach(auth()->user()->id);
           //leer el usuario q esta visitando  su muro  y le va agregar a esta persona yva hacer la persona auntenticada
//puedo creat un modulo y darle el usuario autenticado y el que visita su muro
           return back();
    }

    public function destroy(User $user){

        //eliminar la persona
        $user->followers()->detach(auth()->user()->id);
        return back();

    }

    public function show(User $user){

       // dd($user->username);

       return view('follow',[
        'user'=>$user,
        
      ]);
    }

    public function show_following(User $user){

        return view('following',[
            'user'=>$user,
            
          ]);
    }

}
