@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>

    {!! Form::open(['action' => ['App\Http\Controllers\PostsController@update',$post->id],'method'=>'POST', 'enctype'=>'multipart/form-data'])!!}
    <div class="form-group">
        {{Form::label('title','Title')}}
        {{Form::text('title',$post->title,['class'=>'form-control','placeholder'=> 'Title'])}}
    </div>
    <div class="form-group">
        {{Form::label('body','Body')}}
        {{Form::textarea('body',$post->body,['class'=>' ckeditor form-control','placeholder'=> 'Body text'])}}
    </div>
    {{Form::hidden('_method','PUT')}}

    <div class="form-group">
        {{Form::file('cover_image')}}
    </div>
    <div class="p-1">
        {{Form::submit('submit',['class'=>'btn btn-primary'])}}
    </div>
    {!! Form::close() !!}

@endsection