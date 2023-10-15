<h1> {{ $user->username}}  esta siguiendo a  </h1>

@foreach ($user->followings as $follow)
<div class="p-5 border-grey-500 border-b">
    <!--
        
    -->
   
    <a class="font-bold" href="{{ route('posts.index',$follow->username)}}">
        {{$follow->username}}
    </a>
  
</div>
@endforeach