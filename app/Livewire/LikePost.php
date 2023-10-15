<?php

namespace App\Livewire;

use Livewire\Component;

class LikePost extends Component
{
 //no necesito pasarlo a la vista una vez q se registra en la clase puedo usarlo en la vista 
    //como un componente
  //  public $mensaje="Hola mundo desde un atributo";
    //atributo el cual va a almacenar el contenido
    //no necesito instanciar se instancia en la vista 
    public $post;
    public $isLiked;
    public $likes;

    public function mount($post){
//funciona como un constructor
        //revisa si el usuario ya le dio like
        //
           $this->isLiked=$post->checkLike(auth()->user());
           $this->likes=$post->likes->count();
           //devuelve  1 or null
           //1 = ya le ha dado
           //se queda un valor fijo
    }

    public function like()
    {
       // return "desde la funcion de like";
      //evitar duplicados 
       //devuekve true si hay coincidencia si ya han dado like
       if ($this->post->checkLike(auth()->user()))//como le estoy pasando la variable post 
       {
                 
        $this->post->likes()->where('post_id',$this->post->id)->delete();
        //no podemos usar request aqui , no esta disponible
        $this->isLiked=false; //para reescribir esos valores 0
        //return back();
       // return "ya le dio like";
       $this->likes--;
       }
       else{
         //devuelve false si todavia no existe no ha dado like
         $this->post->likes()->create([
            'user_id'=>auth()->user()->id
          
            ]);
            $this->isLiked=true;//para reescribir esos valores 1
            $this->likes++;
    // return "le dio like";

    // return back();
       }
    }
   
    public function render()
    {
        return view('livewire.like-post');
    }
}
