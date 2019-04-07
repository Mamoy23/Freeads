@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center font-weight-bold">Edit " {{ $ad->title }} "</div>

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
                        <form method="post" action="{{ action('AdController@update', $ad->id) }}" class="form-group col-md-6 offset-md-3" enctype="multipart/form-data">
                            {{csrf_field()}}
                                <input type="text" name="title" class="form-control m-1" value="{{ $ad->title }}" placeholder="Enter your title's ad" />
                                <textarea name="details" id="details" cols="30" rows="10" placeholder="Describe your product here" class="form-control m-1">{{ $ad->details }}</textarea>
                                <input type="number" name="price" value="{{ $ad->price }}" class="form-control m-1" placeholder="Your price"/>
                                <input type="submit" class="btn btn-primary m-1" value="Edit" />
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection