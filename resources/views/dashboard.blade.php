@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
    <div class="container p-3">
        
        <a class="btn btn-primary" href="/posts/create">Create post</a>
        
        <h3 class= "text-center">Your Blog Posts</h3>

        @if (count($posts)>0)
            
        
        <table class="table">
            <thead>
                <tr>
                    <th scope='col'>Title</th>
                    <th scope='col'></th>
                    <th scope='col'></th>
                </tr>
            </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{$post->title}}</td>
                    <td><a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a></td>
                    <td>
                        {!!Form::open([ 'action' => ['App\Http\Controllers\PostsController@destroy',$post->id], 'method' => 'POST' ])!!}
                        {{Form::hidden('_method','DELETE')}}
                        {{Form::submit('delete',['class'=>'btn btn-danger'])}}
                    </td>
                </tr>
                
            @endforeach
        </tbody>

        </table>

        @else
        <p>You have no posts</p>

        @endif
    </div>

</div>
@endsection
