@extends('layout')

@section('content')
    <div class="row">
       
        <div class="col-md-6">
            @include('entrance.password')
        </div>

        <div class="col-md-6">
            @include('entrance.new')
        </div>

    </div>
@endsection