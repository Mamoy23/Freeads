@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center">All the ads</div>

                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            <p>{{ $message }}</p>
                            
                        </div>
                    @endif

                    <div class="container"> 
                    <form method="get" action="{{ action('AdController@search') }}" class="form-inline m-4">
                            {{csrf_field()}}
                            <input type="search" name="search" class="form-control m-1" placeholder="Enter a title or detail" />
                            <input type="number" name="minprice" class="form-control m-1" placeholder="Min price" style="width: 100px;" min=0>
                            <input type="number" name="maxprice" class="form-control m-1" placeholder="Max price" style="width: 105px;" min=0>
                            <select name="category" id="category" class="custom-select">
                                <option value="">Category</option>
                                <option value="vehicle">Vehicle</option>
                                <option value="home">Home</option>
                                <option value="toy">Toy</option>
                                <option value="clothing">Clothing</option>
                            </select>
                            <input type="submit" class="btn btn-outline-success m-1" value="Search" />
                    </form>

                    <a href="{{ action('AdController@searchRecent')}}" class="btn btn-success m-1">Show most recents ads</a>

                    @if (count($ads) === 0)
                    <p class="text-center">No ads found</p>
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
                                        <td><a href="{{ action('AdController@show', $ad->id) }}" class="btn btn-warning">Show details</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection