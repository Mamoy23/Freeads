@extends('layouts.app')


@section('content')
<div class="text-center">
    <h1 class="text-center col-md-6 offset-md-3">Welcome to Freeads, here you can post or search a lot of products !</h1>
    <a href="{{ route('ad.index') }}" class="btn btn-primary" style="font-size: 20px;">Let's start <i class="fas fa-arrow-circle-right ml-1"></i></a>
</div>
@endsection