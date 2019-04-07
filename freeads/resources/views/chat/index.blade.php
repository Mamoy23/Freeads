@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center font-weight-bold" style="font-size: 15px;">Chat</div>

                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            <p>{{ $message }}</p>
                            
                        </div>
                    @endif

                    <div class="container"> 
                        <div class="list-group col-md-6 offset-md-3" style="font-size: 20px;">
                            @foreach ($users as $user)
                            <a class="list-group-item" href="{{ route('chat.show', $user->id) }}">{{ $user->name }}
                                @if (isset($count[$user->id]) && $count[$user->id] != 0)
                                    <span class="badge badge-pill badge-danger m-2"> {{ $count[$user->id] }} </span>
                                @endif
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection