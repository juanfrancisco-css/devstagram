<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    //Todo en este controller debera de estar protegido

    public function __construct()
    {
        //comprobar que esta autenticado 
        //ejecutar primero este metodo
        //el usuario tiene que estar autenticado para acceder a cualquiera de estos methodos
         // $this->middleware('auth');
        //Permitir el acceso para algunos methodos
       $this->middleware('auth')->except(['show','index']);

    }

    public function index(User $user)
    {
//dd($user->username);
       // dd('Desde muro');
      // dd(auth()->user());
      //pasando la informacion del usuario a la vista a traves de un arreglo

      //Cuando llamas al modelo se situa en dicha tabla automaticamente 
      //donde el user_id que esta en la tabla  posts es igual al id de la tabla de usuario que esta autenticado quiero todos sus post 
      //y con get me traigo esos campos que he consultado
     
     // $posts= Post::where('user_id',$user->id)->get();
     $posts= Post::where('user_id',$user->id)->latest()->paginate(4);//Para la paginacion SimplePaginate(5)
     //select post.imagen from post where user_id = al usuario que le estoy pasando por el route model view
     // dd($posts);
      return view('dashboard',[
        'user'=>$user,
        'posts'=>$posts
      ]);
      //lo que hago es delvolver a la vista dos variables
    }

    public function create()
    {
    //  dd('Creando post');

    return view('posts.create');
    }

    public function store(Request $request)
    {
     // dd('guardando datos..');

     $this->validate($request,[
        'titulo'=>'required|max:255',
        'descripcion'=>'required',
        'imagen'=>'required'
     ]);
//debemos de importar el modelo
//aqui guardamos la informacion en la bbdd 
//a esta altura el usuario ya deberia de estar autenticado y podemos utilizar la funcion auth
/*
     Post::create([
         'titulo'=>$request->titulo,
         'descripcion'=>$request->descripcion,
         'imagen'=>$request->imagen,
         'user_id'=>auth()->user()->id
     ]);
*/
     //otra forma
     $post = new Post; //se crear una nueva instancia de ese modelo
     $post->titulo = $request->titulo;
     $post->descripcion = $request->descripcion;
     $post->imagen = $request->imagen;
     $post->user_id = auth()->user()->id;
     $post->save();

     //otra forma
     /*
                    Accedemos al usuario y al methodo que esta en el modelo del usuario 'posts' 
     $request->user()->posts()->create([
         'titulo'=>$request->titulo,
         'descripcion'=>$request->descripcion,
         'imagen'=>$request->imagen,
         'user_id'=>auth()->user()->id
     ]);
     */

     //una vez que se haya creado debemos de devolver al usuario a su perfil 
     return redirect()->route('posts.index',auth()->user()->username);


    }

    //le envio a la vista la variable post para poder acceder a ella  
    //Por parametros le pido el user y el post
    public function show(User $user,Post $post)
    {

        //le envio ala vista la variable post y user
        return view('posts.show',[
            'post'=>$post,
            'user'=>$user
        ]);
    }

    public function destroy(Post $post){
      // dd("Publicacion eliminada" . $post->id .$post->titulo);
/*
      if($post->user_id === auth()->user()->id){
        dd("si tiene derecho a eliminarla");
      }
      else{
        dd("No tiene derecho a eliminarla");
      }
*/

        //llamo al method de Policy dandole el modelo que le he asociado
        $this->authorize('delete',$post);
        //dd('Publicacion eliminada');
        $post->delete();//borro publicacion
        
        //Eliminar la imagen de la carpeta  uploads
       
        $imagen_path= public_path('uploads/'.$post->imagen);

        if(File::exists($imagen_path)){
            //funcion de php que elimina ficheros
            unlink($imagen_path);
            //File::delete($imagen_path)
        }

        //redireccionar a la vista index 
        return redirect()->route('posts.index',auth()->user()->username);

    }
}
