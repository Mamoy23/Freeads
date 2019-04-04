@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">All the ads</div>

                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            <p>{{ $message }}</p>
                            
                        </div>
                    @endif

                    <div class="container">  
                    <a href="ad/create" class="btn btn-success m-1">Add an ad</a>
                    <a href="ad/list" class="btn btn-info m-1">My ads</a>
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
                                        <td><a href="{{ action('AdController@show', $ad->id) }}" class="btn btn-warning">Show details</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection