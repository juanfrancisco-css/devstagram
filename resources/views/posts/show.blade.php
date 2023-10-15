@extends('layouts.app3')

<!-- Aqui ya puedo manipular la varibale que le he pasado -->
@section('titulo')
{{ $post->titulo}}
@endsection

@section('contenido3')
<div class="container  mx-auto md:flex">
    <div class=" mx-5 md:w-1/2">
        
         <img src ="{{ asset('uploads').'/'.$post->imagen}}" alt="Imagen de los posts {{ $post->titulo}}">
         
         <div class="p-3 flex items-center gap-3">

            @auth
           <!--
            Pasar informacion desde el template hacia livewire
            e instaciarlo de una vez
           -->
            <livewire:like-post :post="$post" />
               {{--
            @if ($post->checkLike(auth()->user()))
            <!--
                Ya ha dado like y quiero quitar ese like
            -->
            <form action="{{route('posts.likes.destroy',$post)}}" method="POST">
                @method('DELETE')
                @csrf
                <div class="my-4"> 
                   <button 
                     type="submit"
                   >
        <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
          </svg>
    </button>
                    
                </div>
            @else
          
           <!--
               No he dado like
               guardo esos datos
            -->
            <form action="{{route('posts.likes.store',$post)}}" method="POST">
                @csrf
                <div class="my-4"> 
                    <button type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                          </svg>
                    </button>
                    
                </div>
                </form>
                @endif 
                  --}}
            
           
            @endauth
{{--
            @if ($post->likes->count())
            <a href="{{ route('posts.likes.show',$post)}}">
            {{$post->likes->count()}} likes 
           
            </a>
            @else

            <p>0 like </p>
            @endif
--}}
         </div>
         <div>
            <!-- 
                Utilizo la variable que he enviado para esta vista que su vez utiliza e method user que se 
            encuentra en el modelo (user) diciendo que pertenece a un usuario y que accede al atributo username
           Aqui estoy usando la relacion que tiene con el usuario 
        -->
            <p class="font-bold">
                <a href="{{ route('posts.index', $post->user->username)}}">
                {{ $post->user->username}}  <span class="font-sans font-normal">{{ $post->descripcion}}</span>
                </a>
            </p>

            <p class="text-sm text-gray-500"> 
                {{ $post->created_at->diffForHumans()}}
            </p>

            <p class="mt-5">
                {{ $post->descripcion}}
            </p>
         </div>
         <!--
            Solo puede borrar la publicacion quienes esten autenticados y que sea su publicacion
         -->
@auth
     @if($post->user_id === auth()->user()->id)
                <form action="{{ route('posts.destroy',$post)}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <input
                        type="submit" 
                        value="Eliminar Publicacion"
                        class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4"
                    >
                </form>
@endif
@endauth
         
    </div>
    <div class="md:w-1/2">
        <div class="shadow bg-white p-5 mb-5">
            @auth
           <p class="text-xl font-bold text-center mb-4">
            Agrega un Nuevo Comentario 
           </p>
           @if (session('mensaje'))
           <p class="p-3 bg-green-400 rounded-lg mb-6 text-white text-center uppercase font-bold">
            {{session('mensaje')}}
           </p>
               
           @endif
           <!-- 
            Hago la llamada a la funcion y le doy las variables que me pidan 
            como en el post.show le he enviado las variables atraves de la vista 
           -->
           <form action="{{ route('comentarios.store',['post'=>$post,'user'=> $user])}}" method="POST">
            @csrf
            <div class="mb-5">
              
                    
               
                <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                  Añadir un  Comentario
                </label>
                <textarea
                      id="comentario"
                      name="comentario"
                      placeholder="Escribe tu comentario aqui"
                      class="border p-3 w-full rounded-lg 
                      @error('comentario')
                          border-red-500
                      @enderror"
                    
                >
               
                </textarea>
                @error('comentario')
                    <p class="bg-red-500 text-white rounded-lg my-2 text-sm p-2 ">
                        {{ $message}}

                    </p>
                @enderror
             </div>

                <input 
                type="submit"
                value="Comentar"
                class="bg-sky-600 hover:bg-sky-700 transition-colors
                uppercase font-bold w-full p-3 text-white rounded-lg"
              >
           </form>
           @endauth

        <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
            <!--
                Del modelo POST accedo al methodo 'comentarios' que he creado en el modelo POST
            -->  
        @if ($post->comentarios->count())
                
        <!--
             Debo de recorrer para visualizar 
             Del methodo comentarios que esta en el modelo POST y a su vez de la columna comentario que posee dicha tabla comentarios
        -->
        @foreach ($post->comentarios as $comentario)
        <div class="p-5 border-grey-500 border-b">
            <!--
                Aqui accedo el method  user que tiene el modelo comentario que a su vez puedo acceder al username 
            -->
            <a class="font-bold" href="{{ route('posts.index',$comentario->user->username)}}">
                {{$comentario->user->username}}
            </a>
           <p> {{ $comentario->comentario}}</p>
           <p class="text-grey text-sm"> {{ $comentario->created_at->diffForHumans()}}</p>
        </div>
        @endforeach

        @else
       <p class="p-10 text-center">
        No hay comentarios aun
       </p> 
            
        @endif
        </div>
        </div>
    </div>
</div>
@endsection