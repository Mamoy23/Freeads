@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ $ad->title }}</div>

                <div class="card-body">

                    <div class="d-flex flex-column align-items-center">          
                        <p>{{ $ad->details }}</p>
                        <img src="{{ asset('storage/'.$ad->photo) }}" alt="{{$ad->photo}}" style="width: 200px; height: auto;"/>
                        <p class="text-center font-weight-bold m-2">{{ $ad->price }}€</p>
                    </div>
                        <p>Posté le {{ $ad->created_at }}</p>
                        <a href="/ad" class="btn btn-dark m-1">Back to list</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection