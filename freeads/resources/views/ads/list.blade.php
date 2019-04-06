@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center">My ads</div>

                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            <p>{{ $message }}</p>
                            
                        </div>
                    @endif

                    <div class="container">  
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>Title</td>
                                        <td>Details</td>
                                        <td>Price</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ads as $ad)
                                    <tr>
                                        <td>{{ $ad->title }}</td>
                                        <td>{{ substr($ad->details, 0, 50) }}...</td>
                                        <td>{{ $ad->price }}€</td>
                                        <td><img src="{{ asset('storage/'.$ad->photo) }}" alt="{{$ad->photo}}" style="width: 100px; height: auto;"/></td>
                                        <td><a href="{{ action('AdController@edit', $ad->id) }}" class="btn btn-primary">Edit</a></td>
                                        <td>
                                            <form action="{{ action('AdController@destroy', $ad->id) }}" class="deleteform" method="POST">
                                                {{csrf_field()}}
                                                <input type="hidden" name="_method" value="DELETE" />
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    <a href="create" class="btn btn-success m-1">Add an ad</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.deleteform').on('submit', function(){
            if(confirm('Are you sure you want to delete it?')){
                return true;
            }
            else{
                return false;
            }
        });
    });
</script>
@endsection