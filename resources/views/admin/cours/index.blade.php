@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Ajouter</h5>
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
              <!-- General Form Elements -->
              <form method="POST" action="{{Route('cours.store')}} " class="row g-3">
                  @csrf
                <div class="col-12">
                  <label for="inputText" class="form-label">Nom</label>
                    <input type="text"
                           class="form-control"
                           name="nom"
                           placeholder="Histoire"
                           required>
                </div>

                <div class="col-12">
                  <label for="inputEmail" class="form-label">Sigle</label>
                  
                    <input type="text"
                           class="form-control"
                           required
                           name="slug">
                </div>
                <div class="col-12">
                    <label for="inputPassword" class="form-label">Classe</label>
                    <select class="form-select"
                            aria-label="Default select example"
                            name="classe"
                            id="prof"
                            required>
                        <option selected>Selectionner une classe</option>
                        @foreach ($classes as $classe)
                            <option value="{{$classe->id}} ">
                                {{$classe->nom}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <label for="inputPassword" class="form-label">Cote</label>
                    <input type="number"
                            class="form-control"
                            name="maximum"
                            min="0"
                            required>
                </div>
                <div class="col-12">
                  <label for="inputPassword" class="form-label">Desciprion</label>
                  
                  <textarea class="form-control"
                            style="height: 100px"
                            name="description"></textarea>
                </div>
  
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
  
              </form><!-- End General Form Elements -->
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Index des cours</h5>
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Classe</th>
                            <th>Slug</th>
                            <th>Maximum</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cours as $cour)
                            <tr>
                                <td>{{$cour->nom}}</td>
                                <td>{{$cour->classe->nom}}</td>
                                <td>{{$cour->slug}}</td>
                                <td>{{$cour->maximum}}</td>
                                <td>
                                    <a href="{{Route('cours.edit', $cour->id)}} " class="btn btn-primary">Modifier</a>
                                    <form action="{{Route('cours.destroy', $cour->id)}} " method="POST">
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

</div>
@endsection