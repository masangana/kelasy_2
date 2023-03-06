@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
      <h5 class="card-title">{{$cours->nom}} </h5>
      <!-- Bordered Tabs -->
      <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">General</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Classe</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Cote</button>
        </li>       
        <li class="nav-item">
          <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Administration</button>
        </li>
      </ul>
      <div class="tab-content pt-2" id="borderedTabContent">
        <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
            <h6 class="card-title">
                {{$cours->classe->nom}}
            </h6>
            <p>
                {{$cours->description}}
            </p>
            <hr>
        </div>
        <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
          <div class="table-responsive">
            <table class="table datatable table-striped table-bordered">
              <thead>
                <tr>
                  <th class="align-middle" rowspan="2">#</th>
                  <th class="align-middle" rowspan="2">Nom </th>
                  <th class="align-middle" rowspan="2">Genre</th>
                  @foreach ($periodeTable as $index => $periode)
                    @foreach ($vue_periodes as $periode2)
                      @if ($periode == $periode2->id)
                        @php
                          $span = ${"compte" . $periode2->id};
                        @endphp
                        <th colspan="{{$span}}" class="text-center">{{$periode2->nom}}</th>      
                      @endif
                    @endforeach
                  @endforeach
                  
                </tr>
                <tr>
                  @foreach ($periodeTable as $periode)
                    @foreach ($groupe_cote as $epreuve)
                      @if ($periode == $epreuve->periode_id)
                        @foreach ($epreuves as $uneEpreuve )
                          @if ($epreuve->epreuve_id == $uneEpreuve->id)
                            <th class="text-center">{{$uneEpreuve->nom}} <br>
                              <small>{{$epreuve->max}}</small>
                            </th>
                          @endif
                        @endforeach
                      @endif
                    @endforeach
                  @endforeach
                <tr>
              </thead>
              <tbody>
                @foreach ($cours->classe->eleves as $index => $eleve)
                <tr>
                  <td>{{$index+1}}</td>
                  <td>{{$eleve->personne->nom}} {{$eleve->personne->postnom}} {{$eleve->personne->prenom}}</td>
                  <td>{{$eleve->personne->sexe}}</td>
                  @foreach ($periodeTable as $periode)
                    @foreach ($groupe_cote as $epreuve)
                      @if ($periode == $epreuve->periode_id)
                        @foreach ($eleve->hasCote as $cote)
                          @if ($cote->eleve_id == $eleve->id && $cote->groupe_cote_id == $epreuve->id)
                            <td class="text-center">{{$cote->cote}}</td>
                          @endif
                        @endforeach
                      @endif
                    @endforeach
                  @endforeach
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          
        </div>
        <div class="tab-pane fade" id="bordered-contact" role="tabpanel" aria-labelledby="contact-tab">
          <form action="{{Route('cote_prof.store')}}" class="row g-3" method="POST">
            @csrf
            <input type="hidden" name="cours_id" value="{{$cours->id}}">
            <div class="col-md-3">
                <label for="inputState" class="form-label">Période</label>
                <select id="inputState" class="form-select" name="periode" required>
                  <option selected>Choisir</option>
                  @foreach ($periodes as $periode )
                    <option value="{{$periode->id}}">{{$periode->nom}}</option>
                  @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="inputState2" class="form-label">Epreuve</label>
                <select id="inputState2" class="form-select" name="epreuve" required>
                  <option selected>Choisir</option>
                  @foreach ($epreuves as $epreuve )
                    <option value="{{$epreuve->id}}">{{$epreuve->nom}}</option>
                  @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="inputMax" class="form-label">Max</label>
                <input type="number" name="max" id="inputMax" class="form-control" required min="0">
            </div>
            <div class="col-md-3">
                <label for="comment" class="form-label">Commentaire</label>
                <input type="text" name="commentaire" id="comment" class="form-control" >
            </div>
            <hr>

            @foreach ( $cours->classe->eleves as $eleve )
                <div class="col-md-4">
                    <label for="{{$eleve->id}}" class="form-label">{{$eleve->personne->nom}} {{$eleve->personne->postnom}} {{$eleve->personne->prenom}}</label>
                    <input type="number" name="{{$eleve->id}}" id="{{$eleve->id}}" class="form-control" required min="0">
                </div>
            @endforeach
            <hr>
            <div class="col-12">
              <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
          </form>
        </div>
        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            Cette section va permettre de cloturer une période. Cela va mettre le calcule de la moyenne périodique. 
            Tant qu'une période n'est pas cloturé, nous la moyenne ne sera pas calculée.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>

          <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
            Quand vous cloturer une periode, aucune note ne peut plus etre ajouter ou changer!
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>

          <h3 class="card-title"> Fiche Personnelle de l'eleve</h3>
          <div class="row">
            <div class="col-lg-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Cloturer    une Période</h5>
                  @if($errors->any())
                      {!! implode('', $errors->all('<div>:message</div>')) !!}
                  @endif

                  <form action="{{Route('cours.archive_periode')}}" method="POST">
                    @csrf
                    <input type="hidden" name="annee_scolaire_id" value="{{$annee_scolaire->id}}">
                    <input type="hidden" name="classe_id" value="{{$cours->classe->id}}">
                    <input type="hidden" name="cours_id" value="{{$cours->id}}">
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label">Période</label>
                      <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example" name="periode_id" required>
                          <option value="" >Périodes</option>
                          @foreach ($periodes as $periode )
                            <option value="{{$periode->id}}">{{$periode->nom}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label"></label>
                      <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Valider</button>
                      </div>
                    </div>    
                  </form>
                </div>
              </div>
            </div>
    
            <div class="col-lg-6">  
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Périodes Cloturées</h5>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">Période</th>
                          <th scope="col">Date</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($cours->archivedPeriode as $archive)
                          <tr>
                            <td>{{$archive->periode->nom}}</td>
                            <td>{{$archive->created_at->format('d-m-Y')}}</td>
                            <td>
                              
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
              </div>   
            </div>
          </div>

      </div>
      </div><!-- End Bordered Tabs -->

    </div>
</div>
@endsection