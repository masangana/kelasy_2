@extends('layouts.app')

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
<div class="row">
    <div class="col-lg-2">
        
    </div>
    <div class="col-lg-8">
        @include('personne.create')
    </div>
    <div class="col-lg-2">
    </div>
</div>
@endsection