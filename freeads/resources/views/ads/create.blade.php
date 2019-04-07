@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center font-weight-bold">Hey {{ Auth::user()->name }}, post an ad !</div>

                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            <p>{{ $message }}</p>
                            
                        </div>
                    @endif
                    @if(count($errors) > 0)
                    <div class="alert alert-danger" role="alert">
                        <ul>
                        @foreach($errors->all() as $error)
                            <li class="list-unstyled">{{$error}}</li>
                        @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="container">  
                        <form method="post" action="{{ action('AdController@store') }}" class="form-group col-md-8 offset-md-2" enctype="multipart/form-data">
                            {{csrf_field()}}
                                <input type="text" name="title" class="form-control" placeholder="Enter your title's ad" />
                                <textarea name="details" id="details" cols="30" rows="10" placeholder="Describe your product here" class="form-control"></textarea>
                                <input type="number" name="price" class="form-control" placeholder="Your price"/>
                                <label for="photo" class="form-control">Photo n°1  <input type="file" name="photo"></label>
                                <label for="photo2" class="form-control">Photo n°2  <input type="file" name="photo2"></label>
                                <label for="photo3" class="form-control">Photo n°3  <input type="file" name="photo3"></label>
                                <select name="category" id="category" class="custom-select">
                                    <option value="">Category</option>
                                    <option value="vehicle">Vehicle</option>
                                    <option value="home">Home</option>
                                    <option value="toy">Toy</option>
                                    <option value="clothing">Clothing</option>
                                </select>
                                <input type="submit" class="btn btn-primary" value="Post" />
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection