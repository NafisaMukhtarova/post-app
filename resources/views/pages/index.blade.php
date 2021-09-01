@extends('layouts.app')

@section('content')
    <h1> Project "Posts" </h1> 
    <p>Here you can find interesting posts about everything.</p>
    <p>Authorize to post your own posts</p>
    <a class="bnt bnt-info" href="{{ route('sendmail') }}">Contact us for </a>
@endsection