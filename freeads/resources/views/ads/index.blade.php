@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center font-weight-bold bg-dark text-white" style="font-size: 20px;">All the ads</div>

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
                    <form method="get" action="{{ action('AdController@search') }}" class="form-inline m-4 d-flex justify-content-center">
                            {{csrf_field()}}
                            <input type="search" name="search" class="form-control m-1" value="{{ $search['search'] ?? '' }}" placeholder="Enter a title or detail" />
                            <input type="number" name="minprice" class="form-control m-1" placeholder="Min price" style="width: 100px;" min=0>
                            <input type="number" name="maxprice" class="form-control m-1" placeholder="Max price" style="width: 105px;" min=0>
                            <select name="category" id="category" class="custom-select">
                                <option value="">Category</option>
                                <option value="vehicle" {{ 'vehicle' == ($search['category'] ?? '') ? 'selected' : '' }}>Vehicle</option>
                                <option value="home" {{ 'home' == ($search['category'] ?? '') ? 'selected' : '' }}>Home</option>
                                <option value="toy" {{ 'toy' == ($search['category'] ?? '') ? 'selected' : '' }}>Toy</option>
                                <option value="clothing" {{ 'clothing' == ($search['category'] ?? '') ? 'selected' : '' }}>Clothing</option>
                            </select>
                            <input type="submit" class="btn btn-outline-success m-1" value="Search" />
                    </form>

                    <a href="{{ action('AdController@searchRecent')}}" class="btn btn-light m-1">Show most recents ads</a>

                    @if (count($ads) === 0)
                    <p class="text-center">No ads found</p>
                    @else
                            <table class="table">
                                <tbody>
                                    @foreach($ads as $ad)
                                    <tr>
                                        <td>
                                            <a href="{{ action('AdController@show', $ad->id) }}">
                                                <img src="{{ asset('storage/'.$ad->photo) }}" alt="{{$ad->photo}}" style="width: 150px; height: auto;"/>
                                            </a>
                                        </td>
                                        <td class="font-weight-bold">
                                            <a href="{{ action('AdController@show', $ad->id) }}" class="title">{{ $ad->title }}</a><br />
                                            {{ substr($ad->details, 0, 70) }}...
                                        </td>
                                        <td class="price">{{ $ad->price }}€</td>
                                    
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- <div id="grid">
                            @foreach($ads as $ad)
                                <div class="grid-item">
                                    <a href="{{ action('AdController@show', $ad->id) }}">
                                    <div>
                                        <h3>{{ $ad->title }}</h3>
                                        <img src="{{ asset('storage/'.$ad->photo) }}" alt="{{$ad->photo}}" style="width: 100px; height: auto;"/>
                                        <p>{{ substr($ad->details, 0, 50) }}...</p>
                                        <p>{{ $ad->price }}€</p>
                                    </div>
                                    </a>
                                </div>
                            @endforeach
                            </div>   -->
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection