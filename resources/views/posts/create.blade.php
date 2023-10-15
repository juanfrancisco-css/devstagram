@extends('layouts.app3')

@section('titulo')
Crea una nueva publicación 
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush


@section('contenido3')
<div class="md:flex md:items-center">
    <div class="md:w-1/2 px-10">
        <!--  dropzone para las imagenes  -->
        <form action="{{ route('imagenes.store') }}"  method="POST" enctype="multipart/form-data" id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
            @csrf
        </form>

        <!-- De Prueba
        <form action="{{ route('imagenes.store') }}" method="POST" enctype="multipart/form-data" class="border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
            @csrf
            <input type="file" name="file">
            <button  class="" id="subirArchivo" type="submit">Cargar Archivo</button>
        </form>
    -->

    </div>
    <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0 mr-4">
    

        <form action="{{ route('posts.store')}}" method="POST">
            @csrf
             <div class="mb-5">
                <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">
                    Titulo
                </label>
                <input 
                      id="titulo"
                      name="titulo"
                      type="text"
                      placeholder=" Titulo de la Publicacion"
                      class="border p-3 w-full rounded-lg 
                      @error('titulo')
                          border-red-500
                      @enderror"
                      value="{{ old('titulo')}}"
                >
                @error('titulo')
                    <p class="bg-red-500 text-white rounded-lg my-2 text-sm p-2 ">
                        {{ $message}}

                    </p>
                @enderror
             </div> 

             <div class="mb-5">
                <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">
                    Descripción
                </label>
                <textarea
                      id="descripcion"
                      name="descripcion"
                      placeholder="Descripcion de la Publicacion"
                      class="border p-3 w-full rounded-lg 
                      @error('descripcion')
                          border-red-500
                      @enderror"
                    
                >
                {{ old('descripcion')}}
                </textarea>
                @error('descripcion')
                    <p class="bg-red-500 text-white rounded-lg my-2 text-sm p-2 ">
                        {{ $message}}

                    </p>
                @enderror
             </div> 

             <div>
                <input 
                type="text"
                name="imagen"
                value="{{ old('imagen')}}"
                >
                @error('imagen')
                <p class="bg-red-500 text-white rounded-lg my-2 text-sm p-2 ">
                    {{ $message}}

                </p>
            @enderror
             </div>

             <input 
                              type="submit"
                              value="Publicar"
                              class="bg-sky-600 hover:bg-sky-700 transition-colors
                              uppercase font-bold w-full p-3 text-white rounded-lg"
                       >
        </form>
    </div>
</div>
@endsection