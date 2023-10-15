<div>
    <!-- Simplicity is an acquired taste. - Katharine Gerould -->
  
    @if ($posts->count())
    <div class="mx-5 grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 ">
       @foreach ($posts as $post)
          <div class="">
             <!-- 
                El method me pide una variable la cual al llamar al method se la debemos de pasar
             Pasar una variable 
 
             Hemos hecho una modificacion y en vez de pasar una pasaremos dos varibables
             se pasan a traves de un arreglo
             -->
              <a href="{{ route('posts.show', ['post'=> $post , 'user'=>$post->user]) }}">
                 <img src ="{{ asset('uploads').'/'.$post->imagen}}" alt="Imagen de los posts {{ $post->titulo}}">
              </a>
             
          </div>
       @endforeach
        </div>
 <!-- Para la paginacion-->
        <div class="my-10">
          {{$posts->links()}}
        </div>
    @else
       <p class="text-center text-gray-600 uppercase text-sm font-bold">No hay post</p>
    @endif
   
  
</div>