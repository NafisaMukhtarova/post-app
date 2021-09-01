@extends('layouts.app')

@section('content')
    <h1>Send Mail</h1> 
    <form action="{{ route('sendmailsubmit') }}" method ="POST">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="name"> Your name</label>
            <input type="text" name="name" class="form-control" required >
        </div>

        <div class="form-group">
            <label for="email"> Your email</label>
            <input type="text" name="email" class="form-control" required >
        </div>

        <div class="form-group">
            <label for="message">Type your message</label>
            <textarea name="message" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <input type="submit" name="submit" value="Send" class="btn btn-info">
        </div>

    </form>
@endsection