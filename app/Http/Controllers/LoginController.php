<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //

    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
       // dd('autenticando...');

      // dd($request->remember);  //mantener la sesion abierta on/null

       $this->validate($request,[
        'email'=>'required|email',
        'password'=>'required'
       ]);

       //hepers que nos ayuda a coger solo esos dos campos
                                                           //mantener la sesion abierta on/null
       if(!auth()->attempt($request->only('email','password'),$request->remember)){ //retornar un true or false
        //  En el caso de que el usuario no se pueda autenticar (He negado )
            return back()->with('mensaje','Creendenciales Incorrectas');

       }
//si ha ido todo bien me rediresionara a post index
       //return redirect()->route('posts.index'); Ya no sirve 
       //Ha esta altura el usuario ya esta autenticado
       return redirect()->route('posts.index',auth()->user()->username);
    
    }
}
