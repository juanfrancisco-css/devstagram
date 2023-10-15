<h1>Seguidores de {{ $user->username}}  </h1>

@foreach ($user->followers as $follow)
<div class="p-5 border-grey-500 border-b">
    <!--
        
    -->
   
    <a class="font-bold" href="{{ route('posts.index',$follow->username)}}">
        {{$follow->username}}
    </a>
  
</div>
@endforeach