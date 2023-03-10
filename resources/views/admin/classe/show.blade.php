@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{$classe->nom}} </h5>
                <hr>

                <div class="row">
                    <div class="col-lg-6">
                        <p class="card-text">Sigle: {{$classe->slug}} </p>
                        <p class="card-text">Niveau: {{$classe->niveau}} </p>
                        <p class="card-text">Description: {{$classe->description}} </p>
                    </div>
                </div>

                <hr>
                <h6>Titulaire</h6>
                <div class="row">
                    <div class="col-lg-6">
                        @if ($titulaire == null)
                            <p>
                                Aucun titulaire pour cette classe
                            </p>
                        @else
                            <p>
                                {{$titulaire->personne->nom}} {{$titulaire->personne->postnom}}
                            </p>  
                        @endif
                        
                    </div>
                    
                </div>
                
                
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Les Etudiants</h5>
                <hr>

                <div class="row">
                    <div class="col-lg-6">
                        <p class="card-text">Nombre d'etudiants: {{$classe->eleves->count()}} </p>
                    </div>
                </div>
                <hr>

                <table class="table table-striped datatable">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Post-Nom</th>
                            <th>Prénom</th>
                            <th>Date de naissance</th>
                            <th>
                                Age
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classe->eleves as $etudiant)
                            <tr>
                                
                                    <td>
                                        <a href="{{Route('personne.show', $etudiant->personne )}}">
                                            {{$etudiant->personne->nom}}
                                        </a>
                                    </td>
                                    <td>{{$etudiant->personne->postnom}}</td>
                                    <td>{{$etudiant->personne->prenom}}</td>
                                    <td>
                                        {{$etudiant->personne->date_naissance->format('d-M-Y')}}
                                    </td>
                                    <td class="text-right">
                                        {{$etudiant->personne->date_naissance->age}} Ans
                                    </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Les Cours</h5>
                <hr>

                <div class="row">
                    <div class="col-lg-6">
                        <p class="card-text">Nombre de cours: {{$classe->cours->count()}} </p>
                    </div>
                </div>
                <hr>

                <table class="table table-striped datatable">
                    <thead>
                        <tr>
                            <th>Intitulé</th>
                            <th>Cote</th>
                            <th>Enseignant</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cours as $unCours)
                            <tr>
                                <td>{{$unCours->nom}}</td>
                                <td>{{$unCours->maximum}}</td>
                                <td>
                                    @if ($unCours->professeurs->count() > 0)
                                        <p>
                                            @foreach ($unCours->professeurs as $professeur)
                                                {{$professeur->personne->nom}} {{$professeur->personne->postnom}}
                                            @endforeach
                                        </p>
                                    @else
                                        <form method="POST" action="{{route('cours.add_prof', $unCours)}}">
                                            @csrf
                                            <input type="hidden" name="classe" value="{{$classe->id}}">
                                            <input type="hidden" name="cours" value="{{$unCours->id}}">
                                            <div class="row mb-3">
                                                <label for="inputEmail3" class="col-sm-4 col-form-label">Choisir un enseignant</label>
                                                <div class="col-sm-6">
                                                    <select name="professeur" 
                                                            id="prof" 
                                                            class="form-control"
                                                            required>
                                                        <option value="">Choisir un enseignant</option>
                                                        @foreach ($professeurs as $professeur)
                                                            <option value="{{$professeur->id}}">
                                                                {{$professeur->name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button type="submit" class="btn btn-secondary btn-sm"><i class="bi bi-collection"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    @endif
                                    
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