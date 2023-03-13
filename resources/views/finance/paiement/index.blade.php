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
              <form method="POST" action="{{Route('paiement.store')}} " class="row g-3">
                  @csrf
                
                <div class="col-12">
                    <label for="inputPassword" class="form-label">Elève</label>
                    <select class="form-select"
                            aria-label="Default select example"
                            name="eleve"
                            id="eleve"
                            required>
                        <option selected>Choisir un Elève</option>
                        @foreach ($eleves as $eleve )
                            <option value="{{$eleve->id}}">{{$eleve->personne->nom}} {{$eleve->personne->postnom}} {{$eleve->personne->prenom}} | 
                                {{$eleve->classeParAnnee[0]->nom}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <label for="inputPassword" class="form-label">Montant</label>
                    <input type="number"
                            class="form-control"
                            name="montant"
                            min="0"
                            required>
                </div>
                <div class="col-12">
                    <label for="inputPassword" class="form-label">Motif</label>
                    <select class="form-select"
                            aria-label="Default select example"
                            name="motif"
                            id="prof"
                            required>
                        <option selected>Selectionner un Motif</option>
                        @foreach ($motifs as $motif )
                            <option value="{{$motif->id}}">{{$motif->nom}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12">
                  <label for="inputPassword" class="form-label">Commentaire</label>
                  
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
                <h5 class="card-title">Liste des Paiements</h5>
                <table class="table table-striped datatable">
                    <thead>
                        <tr>
                            <th>Elève</th>
                            <th>Classe</th>
                            <th>Montant en ($) </th>
                            <th>Numéro</th>
                            <th>Date</th>
                            <th>Motif</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paiements as $paiement)
                            <tr>
                                <td>
                                    <a href="{{route('paiement.show',$paiement->eleve->id )}}">
                                        {{$paiement->eleve->personne->nom}} {{$paiement->eleve->personne->postnom}} {{$paiement->eleve->personne->prenom}}
                                    </a>
                                </td>
                                <td>{{$paiement->eleve->classeParAnnee[0]->nom}}</td>
                                <td>{{$paiement->montant}}</td>
                                <td>{{$paiement->numero}}</td>
                                <td>{{$paiement->created_at->format('d-m-Y')}}</td>
                                <td>{{$paiement->motif->nom}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection