<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    //

    public function store(Request $request){

       // return "Desde imagen controller ";

      // $input = $request->all();
       //return response()->json($input);
//los elementos tipo file lo que me devuelve es un array
       $imagen =  $request->file('file');//la imagen esta en memoria
              //Me genera un id unico seguido de la extension
       $nombreImagen= Str::uuid().".". $imagen->extension();//Este es e nombre que se guarda en la base de datos NO SE GUARDA las imagenes 
                      //
       $imagenServidor= Image::make($imagen);//almaceno esa imagen en la memoria raw 
       //esta es la clase que nos permite crear una imagen de intervention io
       $imagenServidor->fit(1000,1000);//limitar un tamaño
       //Utilizo sus atributos

       $imagenPath=public_path('uploads').'/'. $nombreImagen;// le creo una ruta que se guardara en la carpeta uploads/nombre de la imagen

       $imagenServidor->save($imagenPath);//y cargo esos archivos en dicha ruta 

      // return response()->json(['imagen'=> $imagen->extension()]);
      // return response()->json(['imagen'=> "Probando respuesta"]);
      //Esto en lo que se enviara al console.log
     // return response()->json(['imagen'=>"Probando respuesta ". $nombreImagen]);
     return response()->json(['imagen'=>$nombreImagen]);
    }
}
