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
              <form method="POST" action="{{Route('annee_scolaire.store')}} " class="row g-3">
                  @csrf
                <div class="col-12">
                  <label for="inputText" class="form-label">Nom</label>
                    <input type="text"
                           class="form-control"
                           name="nom"
                           placeholder="2023-2024"
                           required>
                </div>
                <div class="col-12">
                  <label for="inputEmail" class="form-label">Date de Début</label>
                  
                    <input type="date"
                           class="form-control"
                           required
                           name="date_debut">
                </div>
                <div class="col-12">
                  <label for="inputPassword" class="form-label">Date de Fin</label>
                    <input type="date"
                           class="form-control"
                           required
                           name="date_fin">
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
                <h5 class="card-title">Index des années</h5>

                <table class="table datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Date de Début</th>
                        <th scope="col">Date de Fin</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($annees as $annee)
                      <tr>
                        <th scope="row">{{$annee->id}}</th>
                        <td>{{$annee->nom}}</td>
                        <td>{{$annee->date_debut->format('d-M-Y') }}</td>
                        <td>{{$annee->date_fin->format('d-M-Y')}}</td>
                        <td>
                            @if ($annee->active == 1)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{Route('annee_scolaire.edit', $annee->id)}} " class="btn btn-primary">Modifier</a>
                            <form action="{{Route('annee_scolaire.destroy', $annee->id)}} " method="POST" class="d-inline">
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