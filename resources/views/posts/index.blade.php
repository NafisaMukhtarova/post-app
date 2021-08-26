@extends('layouts.app')

@section('content')

<div class="row mt-5">
    <h1 class="text-center">Posts</h1>

        @if(count($posts)>0)
        
       <div class = "container">
            @foreach ($posts as $post)
                
                    <div class="card card-body bg-light">
                        <div class ="col-2">
                            <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}" alt="">
                        </div>
                        <div class ="col-6">
                            <h3><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h3>
                            <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
                        </div>
                        
                    </div>
                  
            @endforeach
            
        </div>

        {{ $posts->links() }}
            
        @else
            <p>No posts found</p>
        @endif
        
</div>     
    
@endsection