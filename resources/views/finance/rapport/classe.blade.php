
@extends('layouts.app')

@section('content')
<div class="row">

    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Rapport Par Classe</h5>
          <br>
          <div class="table-responsive">
            <table class="table datatable table-striped table-bordered zero-configuration">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nom</th>
                  <th>Slug</th>
                  <th>Niveau</th>
                </tr>
              </thead>
              <tbody>
                    @foreach ($classes as $index => $classe )
                        <tr>
                            <th scope="row">{{$index + 1}}</th>
                            <td>
                                <a href="{{route('classe_rapport.show', $classe->id)}}">
                                    {{$classe->nom}}
                                </a>
                            </td>
                            <td>{{$classe->slug}}</td>
                            <td>{{$classe->niveau}}</td>
                        </tr>
                    @endforeach
              </tbody>
            </table>

        </div>
      </div>

    </div>
  </div>
@endsection