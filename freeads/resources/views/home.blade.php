@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            <p>{{ $message }}</p>
                            
                        </div>
                    @endif
                    
                    <p>{{ Auth::user()->email }}</p>
                    <p>{{ Auth::user()->name }}</p>
                    <a href="{{action('UserController@edit', Auth::user()->id)}}" class="btn btn-info m-1">Update my profil</a>
                    <!-- <a href="{{action('UserController@destroy', Auth::user()->id)}}" class="btn btn-danger m-1">Delete my profil</a> -->
                    <td>
                        <form action="{{ action('UserController@destroy', Auth::user()->id) }}" class="deleteform" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE" />
                            <button type="submit" class="btn btn-danger m-1">Delete my count</button>
                        </form>
                    </td>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.deleteform').on('submit', function(){
            if(confirm('Are you sure you want to delete your profile?')){
                return true;
            }
            else{
                return false;
            }
        });
    });
</script>
@endsection