@extends('layouts.app')

@section('content')
<div class="pagetitle">
    <h1> {{$isPupil->eleve->personne->nom}} {{$isPupil->eleve->personne->postnom}}
        | {{$classe->nom}} | {{$isPupil->anneeScolaire->nom}}
    </h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Enfant</li>
      </ol>
    </nav>
</div>


@endsection