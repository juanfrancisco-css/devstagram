<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //


    public function index() 
    {
        return view('auth.register');
    }

    public function store(Request $request) 
    {
      //  dd($request);
      //dd($request->get('name'));

      //Modificar el request (Ultima opcion)
      $request->request->add(['username'=> Str::slug($request->username)]);//me convierte en username en nombre valido para una url

      //validaciones
      $this->validate($request,[
               'name'=>'required|min:4|max:30',
               'username'=>'required|unique:users|min:3|max:20',
               'email'=>'required|unique:users|email|max:60',
               'password'=>'required|confirmed|min:6',
      ]);

     // dd('Creando usuario');


    /*
    
    Se puede hacer desde el Modelo o incluso en algunos casos ya vienen introducido . Pero en el caso
    de que no venga deberias de hacer esto .
    Acuerdate de importar la clase .

    'password'=>Hash::make($request->password)
    */

     //Ya no hace falta  'username'=>Str::slug( $request->username),
     //aqui ya se guarda los datos en la base de datos
      User::create([
            'name'=>$request->name,
           'username'=> $request->username,
            'email'=>$request->email,
            'password'=>$request->password
      ]);

      //Autenticar un usuario 
      /*
      auth()->attempt([
        'email'=> $request->email,
        'password'=> $request->password
      ]);
      */
      //Otra forma de autenticar 

      auth()->attempt($request->only('email','password'));

      //Redireccionar
     // return redirect()->route('post.index');
     return redirect()->route('posts.index',auth()->user()->username);

    }
}
