@extends('layouts.app')

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    @include('personne.index')
@endsection