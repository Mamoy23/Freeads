@extends('layouts.app')

@section('content')
<div class="container" style="font-size: 20px;">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center font-weight-bold bg-dark text-white">Matching</div>

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
                        <p class="text-center font-italic">Let us know a little more about you, and find your perfect product !</p>

                        <form action="{{ action('AdController@matching') }}" method="post" class="d-flex flex-column justify-content-center">
                            {{ csrf_field() }}
                            <div class="p-2">
                                <p>You're looking for something ...</p>
                                <input type="radio" id="home" name="look" value="home">
                                <label for="home">in your home</label>
                                <input type="radio" id="vehicle" name="look" value="vehicle">
                                <label for="vehicle">to move</label>
                                <input type="radio" id="clothing" name="look" value="clothing">
                                <label for="clothing">to wear</label>
                                <input type="radio" id="toy" name="look" value="toy">
                                <label for="toy">to play</label>
                            </div>
                            <div class="p-2">
                                <p>What is your maximum budget ?</p>
                                <input type="number" name="maxprice" class="form-control col-md-3" min=0>
                            </div>
                            <button type="submit" class="btn btn-outline-danger col-md-4 offset-md-4" style="font-size: 20px;">Go match <i class="fas fa-heartbeat"></i></button>
                        </form>
                        @if ($is_post)
                        @if (count($ads) === 0)
                            <p class="text-center">No match found, sorry <i class="fas fa-heart-broken"></i></p>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>Title</td>
                                        <td>Details</td>
                                        <td>Price</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ads as $ad)
                                    <tr>
                                        <td class="font-weight-bold">{{ $ad->title }}</td>
                                        <td>{{ substr($ad->details, 0, 50) }}...</td>
                                        <td>{{ $ad->price }}€</td>
                                        <td><img src="{{ asset('storage/'.$ad->photo) }}" alt="{{$ad->photo}}" style="width: 100px; height: auto;"/></td>
                                        <td><a href="{{ action('AdController@show', $ad->id) }}" class="btn btn-dark">Details</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection