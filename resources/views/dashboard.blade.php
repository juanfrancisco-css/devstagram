@extends('layouts.app3')

<!--  Como ya le estoy pasando el objeto user lo puedo usar para acceder a sus propiedades -->
@section('titulo')

Perfil: {{ $user->username}}
@endsection

@section('contenido3')
@if (session('mensaje_password'))
<p class="bg-green-500 text-white rounded-lg my-2 text-sm p-2 ">
        {{session('mensaje_password')}}
</p>
    @endif
   <div class="flex justify-center">
     
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
               <!--
                  Imagen del usuario
               -->
           <!--<img src="{{ asset('img/usuario.svg')}}" alt="imagen de usuario">-->
           @if ($user->imagen)
           <img src=" {{ asset('perfiles').'/'.$user->imagen}}" alt="Imagen de perfil del usser {{ $user->username}}" class="rounded-full w-15 h-15 object-cover">
            @else
            <img src="{{ asset('img/usuario.svg')}}" alt="imagen de usuario">
           @endif
          
         </div> 
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center justify-center md:items-start py-10  m:py-10">
               <!-- Utilizo esa informacion del usuario para imprimir sus datos-->
      <div class="flex items-center gap-2">
            <p class="text-gray-700 text-2xl mt-5 mb-4">{{$user->username}}
            </p>
            @auth
               @if ($user->id === auth()->user()->id)
                  
                      <a 
                      class="text-gray-500 hover:text-gray-600 cursor-pointer" 
                      href="{{route('perfil.index')}}"
                      >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                         </svg>
                         
                         
                      </a>
                  
               @endif
            @endauth
      </div> 
           <p class="text-gray-800 text-sm mb-3 font-bold">
            <!--Seguidores-->
           <a href="{{ route('users.follow.show',$user)}}"> 
            {{ $user->followers->count()}}
           </a>
            <span class="font-normal">@choice('Seguidor|Seguidores',$user->followers->count())</span>
            <!---->
           </p> 
           <!--Siguiendo-->
           <p class="text-gray-800 text-sm mb-3 font-bold">
            <a href="{{route('users.following.show',$user)}}">
            {{ $user->followings->count()}}
            </a>
            <span class="font-normal">Siguiendo</span>
           </p>
           <p class="text-gray-800 text-sm mb-3 font-bold">
            {{$posts->count()}}
            <span class="font-normal">Post</span>
           </p>  
<!--
   Form de seguimiento
   solo lo puede ver quien este autenticado
   No puede seguirse a si mismo
-->
           @auth
                @if ($user->id !== auth()->user()->id)

               
                @if ($user->siguiendo(auth()->user()))
                        <form action="{{ route('users.unfollow',$user)}}" method="POST">
                           @method('DELETE')
                           @csrf
                           <input 
                           type="submit"
                           value="Dejar de Seguir"
                           class="bg-red-600 text-white rounded-lg uppercase px-3 py-1 text-xs font-bold cursor-pointer"
                           >
                        </form>

                 @else
                        <form action="{{ route('users.follow',$user)}}" method="POST">
                           @csrf
                           <input 
                           type="submit"
                           value="Seguir"
                           class="bg-blue-600 text-white rounded-lg uppercase px-3 py-1 text-xs font-bold cursor-pointer"
                           >
                 </form>

                @endif
                       
                
      
                 
                @endif
          
           @endauth
           
        </div> 
        </div>
  </div>

  <section>
   <h2 class="text-4xl text-center font-black my-10">Publicaciones </h2>
   <!--Es un helper que me cuenta cuantos post tenemos 
      Si hay mas de cero 
   -->
   <!--
      Componente 
   -->
   <x-listar-post :posts="$posts"/>
  
  </section>
   @endsection