<h1>Les gusta a </h1>


@foreach ($post->likes as $like)

<div class="p-5 border-grey-500 border-b">
    <!--
        
    -->
   
    <a class="font-bold" href="{{ route('posts.index', $like->user)}}">
        {{$like->user->username}}
    </a>
  
</div>
@endforeach