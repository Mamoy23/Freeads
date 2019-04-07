@extends('layouts.app')

@section('content')

  <br />
  <h3 class="text-center">Edit Profile</h3>
  <br />
  <div class="container">  
  @if(count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        <ul>
        @foreach($errors->all() as $error)
            <li class="list-unstyled">{{$error}}</li>
        @endforeach
        </ul>
    </div>
  @endif
    <form method="post" action="{{ action('UserController@update', Auth::user()->id) }}" class="form-group col-md-6 offset-md-3">
        {{csrf_field()}}
            <input type="text" name="name" class="form-control" value="{{$user->name}}" placeholder="Enter your name" />
            <input type="email" name="email" class="form-control" value="{{$user->email}}" placeholder="Enter your mail" />
            <input type="submit" class="btn btn-primary" value="Edit" />
    </form>
  </div>

@endsection