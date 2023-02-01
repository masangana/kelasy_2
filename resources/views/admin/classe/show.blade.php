@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{$classe->nom}} </h5>
                
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Liste des Classes</h5>
                
            </div>
        </div>
    </div>
    <div class="col-lg-2">
    </div>
</div>
@endsection