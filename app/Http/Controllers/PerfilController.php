<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    //debemos de proteger esta ruta

    public function __construct()
    {
        $this->middleware('auth');// ahora en adelante todas las views solo accedera el autenticado
    }

    public function index()
    {
         // dd("visualizando perfil de " . $user->username);

         return view('perfil.index');
    }

    public function store(Request $request)
    {

       // dd('Desde perfil store');

       $request->request->add(['username'=> Str::slug($request->username)]);//me convierte en username en nombre valido para una url

//validar los datos que envio
       $this->validate($request,[

       // 'username'=>'required|unique:users|min:3|max:20', si tienes mas de 3 reglas ponerlo en un arreglo recomendable
       //Me permite pillar mi pripio username en caso de q lo escriba
        'username'=>['required','unique:users,username,'.auth()->user()->id,'min:3','max:20','not_in:twitter,editar-perfil'],
        'email'=>['required','unique:users,email,'.auth()->user()->id,'email','max:60'],
       

       ]);

       /*
      
       if (Hash::check($request->input('password'),auth()->user()->password)) {
        // Las contraseñas coinciden, el usuario está autenticado
       dd('Las contraseñas coinciden Vieja'." Nueva: ".$request->password_new);
        
    } else {
        // Las contraseñas no coinciden, muestra un mensaje de error
       // dd('Las contraseñas no coinciden');

       return back()->with('mensaje','La contraseña proporcionada por el usuario es incorrecta  Lo sentimos no pudimos actualizar los cambios');
    }
            
      */


       if($request->imagen){

       // dd("Si hay imagen");

       //los elementos tipo file lo que me devuelve es un array
      // $imagen =  $request->file('file');//la imagen esta en memoria
      $imagen =  $request->file('imagen');//el name del input file es imagen
              //Me genera un id unico seguido de la extension
       $nombreImagen= Str::uuid().".". $imagen->extension();//Este es e nombre que se guarda en la base de datos NO SE GUARDA las imagenes 
                      //
       $imagenServidor= Image::make($imagen);//almaceno esa imagen en la memoria raw 
       //esta es la clase que nos permite crear una imagen de intervention io
       $imagenServidor->fit(1000,1000);//limitar un tamaño
       //Utilizo sus atributos

       $imagenPath=public_path('perfiles').'/'. $nombreImagen;// le creo una ruta que se guardara en la carpeta perfiles/nombre de la imagen

       $imagenServidor->save($imagenPath);//y cargo esos archivos en dicha ruta 

       }
      /* else{
        dd("No hay imagen");
       }
       */

       //guardar cambioss
       $usuario= User::find(auth()->user()->id);
       $usuario->username=$request->username;
       //revisa si le he dado una imagen si no hay revisa si el usuario tenia una antes y si no hoy pues la deja null
       $usuario->imagen=$nombreImagen ?? auth()->user()->imagen ?? null;
       // $usuario->imagen=$nombreImagen ??  null;
      // $usuario->imagen=$nombreImagen ?? ''; si no existe una imagen dejalo vacio 
      //lo puedo hacer pues tengo la opcion nullable en la migracion
      //pero me propone un problema pues si no le cargo una foto me la quita 
      $usuario->email=$request->email;

       $usuario->save();//guardar

     


       return redirect()->route('posts.index',$usuario->username);
       //puede q el usuario haya cambiado el username por eso le pasamos su ultima instancia 
       //por eso no podemos usar auth()->user()
    }
//añadido por mi
    public function create(){
      
        return view('perfil.formpass');
    }
//añadido por mi
    public function create_store(Request $request){

       // dd("cambiar password");
       $this->validate($request,[

        'password'=>'required|min:6',
        'password_new'=>'required|min:6',
 
        ]);
       //primero debemos comprobar que el password coincida con el del usuario para proceder con el cambio

    if (Hash::check($request->input('password'),auth()->user()->password)) {
        // Las contraseñas coinciden, el usuario está autenticado
        $usuario= User::find(auth()->user()->id);
        $usuario->password=Hash::make($request->password_new);//hashear el nuevo password
        $usuario->save();//guardar los cambios

  return redirect()->route('posts.index',$usuario->username) ->with('mensaje_password', 'Password ha sido cambiado con exito');

        
    } else {
        // Las contraseñas no coinciden, muestra un mensaje de error
       // dd('Las contraseñas no coinciden');

       return back()->with('mensaje','La contraseña proporcionada por el usuario es incorrecta  Lo sentimos no pudimos actualizar los cambios');
    }
    }
}
