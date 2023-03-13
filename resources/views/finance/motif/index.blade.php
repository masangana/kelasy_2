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
              <form method="POST" action="{{Route('motif.store')}} " class="row g-3">
                  @csrf
                <div class="col-12">
                  <label for="inputText" class="form-label">Nom</label>
                    <input type="text"
                           class="form-control"
                           name="nom"
                           placeholder="Motif de Paiement"
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
                <h5 class="card-title">Index des Motifs de Paiement</h5>
                <table class="table table-striped datatable">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($motifs as $motif)
                            <tr>
                                <td>{{$motif->nom}}</td>
                                <td>{{$motif->description}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            @if ($motif->nom != "Scolarité")
                                                <a href="{{Route('motif.edit', $motif->id)}} " class="dropdown-item">Modifier</a>
                                                <form action="{{Route('motif.destroy', $motif->id)}} " method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="d-none">Supprimer</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                    
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