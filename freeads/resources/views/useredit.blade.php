@extends('layouts.app')

@section('content')

  <br />
  <h3 class="text-center">Edit Profile</h3>
  <br />
  @if(count($errors) > 0)

  <div class="alert alert-danger">
         <ul>
         @foreach($errors->all() as $error)
          <li>{{$error}}</li>
         @endforeach
         </ul>
  @endif
  <div class="container">  
    <form method="post" action="{{ action('UserController@update', Auth::user()->id) }}" class="form-group">
        {{csrf_field()}}
            <!-- <input type="hidden" name="_method" value="PATCH" /> -->
            <input type="text" name="name" class="form-control" value="{{$user->name}}" placeholder="Enter your name" />
            <input type="email" name="email" class="form-control" value="{{$user->email}}" placeholder="Enter your mail" />
            <input type="submit" class="btn btn-primary" value="Edit" />
    </form>
  </div>

@endsection