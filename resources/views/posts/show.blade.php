@extends('layouts.app')

@section('content')
    <div class="m-3">
        <a class="btn btn-primary" href="/posts" >Go back</a>
    </div>
    <h1>{{ $post->title }}</h1>

    <div class ="container">
        {!! $post->body !!}
    </div>
    <hr>
    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
    <hr>

    @if (!Auth::guest())
        @if (Auth::user()->id == $post->user_id)    
    
            <div class="m-3">
                <a class="btn btn-primary" href="/posts/{{$post->id}}/edit" >Edit</a>
            </div>
            <div class="m-3">
                {!!Form::open([ 'action' => ['App\Http\Controllers\PostsController@destroy',$post->id], 'method' => 'POST' ])!!}
                {{Form::hidden('_method','DELETE')}}
                {{Form::submit('delete',['class'=>'btn btn-danger'])}}
                {!!Form::close()!!}
            </div>

        @endif
    @endif
    
    
    
@endsection