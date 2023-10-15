@extends('layouts.app3')

@section('titulo')
Editar Perfil : {{ auth()->user()->username}}
@endsection

@section('contenido3')
<div class="md:flex md:justify-center">
    <div class="md:w-1/2 bg-white shadow p-6">
                <form class="mt-10 md:mt-0" method="POST" action="{{route('perfil.create.store')}}" >
                    @csrf
                        <div class="mb-5">
                            @if (session('mensaje'))
                        <p class="bg-red-500 text-white rounded-lg my-2 text-sm p-2 ">
                                {{session('mensaje')}}
                        </p>
                            @endif
                            <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                                Password Actual
                            </label>
                            <input 
                                id="password"
                                name="password"
                                type="password"
                                placeholder="Actual Password de Registro"
                                class="border p-3 w-full rounded-lg 
                                @error('password')
                                    border-red-500
                                @enderror"
                                @if (session('mensaje'))
                                class="border-red-500"
                                @endif
                                
                                
                            >
                            @error('password')
                                <p class="bg-red-500 text-white rounded-lg my-2 text-sm p-2 ">
                                    {{ $message}}

                                </p>
                            @enderror
                        </div> 

                        <div class="mb-5">
                            <label for="password_new" class="mb-2 block uppercase text-gray-500 font-bold">
                            Nuevo  Password
                            </label>
                            <input 
                                id="password_new"
                                name="password_new"
                                type="password"
                                placeholder="Nuevo Password de Registro"
                                class="border p-3 w-full rounded-lg 
                                @error('password_new')
                                    border-red-500
                                @enderror"
                                
                            >
                            @error('password_new')
                                <p class="bg-red-500 text-white rounded-lg my-2 text-sm p-2 ">
                                    {{ $message}}

                                </p>
                            @enderror
                        </div> 

                        <input 
                        type="submit"
                        value="Modificar Password"
                        class="bg-sky-600 mt-6 hover:bg-sky-700 transition-colors
                        uppercase font-bold w-full p-3 text-white rounded-lg"
                 >
        </form>
    </div>
</div>
@endsection