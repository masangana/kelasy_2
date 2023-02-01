@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-2">
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Liste des Classes</h5>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Niveau</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($classes as $classe)
                    <tr>
                        <th scope="row">{{$classe->id}}</th>
                        <td>
                            <a href="{{route('classes.show', $classe->id)}}">
                                {{$classe->nom}}
                            </a>
                        </td>
                        <td>{{$classe->slug}}</td>
                        <td>{{$classe->niveau}}</td>
                        <td>
                        <a href="{{route('classes.edit', $classe->id)}}" class="btn btn-primary">Modifier</a>
                        <form action="{{route('classes.destroy', $classe->id)}}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
          </div>
    </div>
    <div class="col-lg-2">
    </div>
</div>
@endsection