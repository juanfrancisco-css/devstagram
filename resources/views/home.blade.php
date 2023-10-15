@extends('layouts.app3')

@section('titulo')
Pagina Principal
@endsection

@section('contenido3')

<!-- 
   Le estoy pasando la varibale  pues me la han pasado desde el controllador
-->
<x-listar-post :posts="$posts"/>

   

@endsection
