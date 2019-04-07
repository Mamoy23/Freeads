@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center" style="font-size: 20px;">{{ $ad->title }}</div>

                <div class="card-body">
                    <div class="d-flex flex-column align-items-center">          
                    @if (!empty($ad->photo2) && !empty($ad->photo3))
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style="width: 300px; height: 300px;">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                            <img class="d-block" src="{{ asset('storage/'.$ad->photo) }}" alt="First slide" style="width: 300px; height: 300px;">
                            </div>
                            <div class="carousel-item">
                            <img class="d-block" src="{{ asset('storage/'.$ad->photo2) }}" alt="Second slide" style="width: 300px; height: 300px;">
                            </div>
                            <div class="carousel-item">
                            <img class="d-block" src="{{ asset('storage/'.$ad->photo3) }}" alt="Third slide" style="width: 300px; height: 300px;">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    @else
                        <img src="{{ asset('storage/'.$ad->photo) }}" alt="{{$ad->photo}}" style="width: 300px; height: auto;"/>
                    
                    @endif
                        <p class="text-center m-2" style="font-size: 15px;">{{ $ad->details }}</p>
                        <p class="text-center font-weight-bold m-2">{{ $ad->price }}€</p>
                    </div>
                        <p>Posté le {{ $ad->created_at }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection