@extends('layouts.app3')

@section('titulo')
Inicia Sesión en DevStagram
@endsection

@section('contenido3')
        <div class="md:flex md:justify-center  md:gap-10 md:items-center">
            <div class="md:w-6/12 p-5">
               <img src="{{ asset('img/login.jpg')}}" alt=" Imagen de Inicio de sesion">
            </div>
            <div class="md:w-4/12  bg-white p-6 rounded-lg shadow-lg ">
                    <form method="POST" action="{{ route('login')}}" novalidate>
                        @csrf
                        
                        @if (session('mensaje'))
                        <p class="bg-red-500 text-white rounded-lg my-2 text-sm p-2 ">
                            {{ session('mensaje')}}
                        </p>
                        @endif

                         <div class="mb-5">
                            <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                                Email
                            </label>
                            <input 
                                  id="email"
                                  name="email"
                                  type="email"
                                  placeholder="Tu Email"
                                  class="border p-3 w-full rounded-lg 
                                  @error('email')
                                      border-red-500
                                  @enderror"
                                  value="{{ old('email')}}"
                            >
                            @error('email')
                                <p class="bg-red-500 text-white rounded-lg my-2 text-sm p-2 ">
                                    {{ $message}}

                                </p>
                            @enderror
                         </div> 
                         <div class="mb-5">
                            <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                                Password
                            </label>
                            <input 
                                  id="password"
                                  name="password"
                                  type="password"
                                  placeholder="Password de Registro"
                                  class="border p-3 w-full rounded-lg 
                                  @error('password')
                                      border-red-500
                                  @enderror"
                                 
                            >
                            @error('password')
                                <p class="bg-red-500 text-white rounded-lg my-2 text-sm p-2 ">
                                    {{ $message}}

                                </p>
                            @enderror
                         </div> 
                        

                         <div class="mb-5">
                            <input type="checkbox" name="remember" ><label class=" text-gray-500 font-bold pl-3">Mantener la session abierta</label>
                         </div> 
                         <input 
                              type="submit"
                              value="Iniciar Sesión"
                              class="bg-sky-600 hover:bg-sky-700 transition-colors
                              uppercase font-bold w-full p-3 text-white rounded-lg"
                       >
                    </form> 
            </div> 

        </div>
@endsection
