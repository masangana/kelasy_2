@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-2">
    </div>
    <div class="col-lg-8">
        <h5>Ajouter un eleve</h5>
        <hr>
        @include('personne.create')
    </div>
    <div class="col-lg-2">
    </div>
</div>
@endsection