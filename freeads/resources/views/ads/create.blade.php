@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Hey {{ Auth::user()->name }}, post an ad !</div>

                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            <p>{{ $message }}</p>
                            
                        </div>
                    @endif
                    @if(count($errors) > 0)

<div class="alert alert-danger">
       <ul>
       @foreach($errors->all() as $error)
        <li>{{$error}}</li>
       @endforeach
       </ul>
@endif

                    <div class="container">  
                        <form method="post" action="{{ action('AdController@store') }}" class="form-group" enctype="multipart/form-data">
                            {{csrf_field()}}
                                <!-- <input type="hidden" name="_method" value="PATCH" /> -->
                                <input type="text" name="title" class="form-control" placeholder="Enter your title's ad" />
                                <textarea name="details" id="details" cols="30" rows="10" placeholder="Describe your product here" class="form-control"></textarea>
                                <input type="number" name="price" class="form-control" placeholder="Your price"/>
                                <input type="file" name="photo">
                                <!-- <input type="text" name="photo"> -->
                                <input type="submit" class="btn btn-primary" value="Post" />
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection