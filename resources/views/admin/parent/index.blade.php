@extends('layouts.app')


@section('content')
    <div class="card">
        <div class="card-body">
        <h5 class="card-title">{{$view}}</h5>

        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
            <li class="breadcrumb-item active">Default</li>
            </ol>
        </nav>
        </div>
    </div>
    @include('personne.index')
@endsection