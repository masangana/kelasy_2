
@extends('layouts.app')

@section('content')
<section class="section profile">
  <div class="row">
    <div class="col-xl-4">
      <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
          <img src="{{asset("images/eleve/".$eleve->personne->photo)}}" alt="Profile" class="rounded-circle">
          <h2>{{$eleve->personne->prenom}} {{$eleve->personne->nom}}</h2>
          <h3>{{$eleve->personne->profession}}</h3>
          <div class="social-links mt-2">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
      </div>

    </div>

    <div class="col-xl-8">
      <div class="card">
        <div class="card-body pt-3">
          <ul class="nav nav-tabs nav-tabs-bordered">
            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
            </li>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">E-Bulletin</button>
            </li>
          </ul>
          <div class="tab-content pt-2">
            <div class="tab-pane fade show active profile-overview" id="profile-overview">
             
              <h5 class="card-title"> Détails Du Profile</h5>
              <div class="row">
                <div class="col-lg-6">
                  <div class="col-lg-3 col-md-4 label ">Nom</div>
                  <div class="col-lg-9 col-md-8"> {{$eleve->personne->nom}} {{$eleve->personne->postnom}} {{$eleve->personne->prenom}} </div>
                </div>
                <div class="col-lg-6">
                  <div class="col-lg-6 col-md-4 label">Genre</div>
                  <div class="col-lg-6 col-md-8">{{$eleve->personne->sexe =='M' ? 'Masculin' : 'Feminin'}}</div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="col-lg-6 col-md-4 label">Lieu de Naissance</div>
                  <div class="col-lg-6 col-md-8">{{$eleve->personne->lieu_naissance}}</div>
                </div>
                <div class="col-lg-6">
                  <div class="col-lg-6 col-md-4 label">Date de Naissance</div>
                  <div class="col-lg-6 col-md-8">{{$eleve->personne->date_naissance->format("d-M-Y")}}</div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-lg-6">
                    <div class="col-lg-6 col-md-4 label">Téléphone</div>
                    <div class="col-lg-6 col-md-8">{{$eleve->personne->telephone}}</div>
                </div>
                <div class="col-lg-6">
                  <div class="col-lg-6 col-md-4 label">Adresse</div>
                  <div class="col-lg-6 col-md-8">{{$eleve->personne->adresse}}</div>
                </div>
              </div>
             
              <div class="row">
                <div class="col-lg-6">
                  <div class="col-lg-6 col-md-4 label">E-mail</div>
                  <div class="col-lg-6 col-md-8">{{$eleve->personne->email}}</div>
                </div>
                
              </div>
             
            </div>

            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                <h5 class="card-title">
                    
                </h5>

                <table class="text-center table table-bordered">
                  <thead>
                    <tr>
                      <th class="align-middle" rowspan="2">
                        BRANCHES
                      </th>
                      <th colspan="4">
                        PREMIER SEMESTRE
                      </th>
                      <th colspan="4">
                        SEMESTRE SECOND
                      </th>
                      <th class="align-middle" rowspan="2">
                        T.G
                      </th>
                    </tr>
                    <tr>
                      <th>
                        1e P
                      </th>
                      <th>
                        2e P
                      </th>
                      <th>
                        EXAM
                      </th>
                      <th>
                        TOT
                      </th>
                      <th>
                        1e P
                      </th>
                      <th>
                        2e P
                      </th>
                      <th>
                        EXAM
                      </th>
                      <th>
                        TOT
                      </th>
                
                    </tr>
                    <tr>
                      <th class="text-rigth">
                        MAXIMA
                      </th>
                      <th>
                        10
                      </th>
                      <th>
                        10
                      </th>
                      <th>
                        20
                      </th>
                      <th>
                        40
                      </th>
                      <th>
                        10
                      </th>
                      <th>
                        10
                      </th>
                      <th>
                        20
                      </th>
                      <th>
                        40
                      </th>
                      <th>
                        80
                      </th>
                    </tr>
                  </thead>

                  <tbody>
                    @foreach ( $classes as $classe )
                      @if ($classe->id == $classe_active->classe_id)
                        @foreach ( $classe->cours as $cours )
                          @if ($cours->max_periode == 10)
                            <tr>
                              <th scope="row" class="text-left">
                                {{$cours->nom}}
                              </th>
                              <td>
                                10
                              </td>
                              <td>
                                10
                              </td>
                              <td>
                                20
                              </td>
                              <td>
                                40
                              </td>
                              <td>
                                10
                              </td>
                              <td>
                                10
                              </td>
                              <td>
                                20
                              </td>
                              <td>
                                40
                              </td>
                              <td>
                                80
                              </td>
                            </tr>
                          @endif
                        @endforeach
                      @endif
                    @endforeach
                    
                    <tr>
                      <th scope="row">
                        MAXIMA
                      </th>
                      <th>
                        20
                      </th>
                      <th>
                        20
                      </th>
                      <th>
                        40
                      </th>
                      <th>
                        80
                      </th>
                      <th>
                        20
                      </th>
                      <th>
                        20
                      </th>
                      <th>
                        40
                      </th>
                      <th>
                        80
                      </th>
                      <th>
                        160
                      </th>
                    </tr>
                    @foreach ( $classes as $classe )
                      @if ($classe->id == $classe_active->classe_id)
                        @foreach ( $classe->cours as $cours )
                          @if ($cours->max_periode == 20)
                            <tr>
                              <th scope="row" class="text-left">
                                {{$cours->nom}}
                              </th>
                              <td>
                                10
                              </td>
                              <td>
                                10
                              </td>
                              <td>
                                20
                              </td>
                              <td>
                                40
                              </td>
                              <td>
                                10
                              </td>
                              <td>
                                10
                              </td>
                              <td>
                                20
                              </td>
                              <td>
                                40
                              </td>
                              <td>
                                80
                              </td>
                            </tr>
                          @endif
                        @endforeach
                      @endif
                    @endforeach
                    <tr>
                      <th scope="row">
                        MAXIMA
                      </th>
                      <th>
                        40
                      </th>
                      <th>
                        40
                      </th>
                      <th>
                        80
                      </th>
                      <th>
                        160
                      </th>
                      <th>
                        40
                      </th>
                      <th>
                        40
                      </th>
                      <th>
                        80
                      </th>
                      <th>
                        160
                      </th>
                      <th>
                        320
                      </th>
                    </tr>
                    @foreach ( $classes as $classe )
                      @if ($classe->id == $classe_active->classe_id)
                        @foreach ( $classe->cours as $cours )
                          @if ($cours->max_periode == 40)
                            <tr>
                              <th scope="row" class="text-left">
                                {{$cours->nom}}
                              </th>
                              <td>
                                10
                              </td>
                              <td>
                                10
                              </td>
                              <td>
                                20
                              </td>
                              <td>
                                40
                              </td>
                              <td>
                                10
                              </td>
                              <td>
                                10
                              </td>
                              <td>
                                20
                              </td>
                              <td>
                                40
                              </td>
                              <td>
                                80
                              </td>
                            </tr>
                          @endif
                        @endforeach
                      @endif
                    @endforeach
                    <tr>
                      <th scope="row">
                        MAXIMA
                      </th>
                      <th>
                        50
                      </th>
                      <th>
                        50
                      </th>
                      <th>
                        100
                      </th>
                      <th>
                        200
                      </th>
                      <th>
                        50
                      </th>
                      <th>
                        50
                      </th>
                      <th>
                        100
                      </th>
                      <th>
                        200
                      </th>
                      <th>
                        400
                      </th>
                    </tr>
                    @foreach ( $classes as $classe )
                      @if ($classe->id == $classe_active->classe_id)
                        @foreach ( $classe->cours as $cours )
                          @if ($cours->max_periode == 50)
                            <tr>
                              <th scope="row" class="text-left">
                                {{$cours->nom}}
                              </th>
                              <td>
                                10
                              </td>
                              <td>
                                10
                              </td>
                              <td>
                                20
                              </td>
                              <td>
                                40
                              </td>
                              <td>
                                10
                              </td>
                              <td>
                                10
                              </td>
                              <td>
                                20
                              </td>
                              <td>
                                40
                              </td>
                              <td>
                                80
                              </td>
                            </tr>
                          @endif
                        @endforeach
                      @endif
                    @endforeach
                    
                    @php
                      $maxiPer = 0;
                      $maxExam = 0;
                      $maxGen = 0;
                    @endphp
                    @foreach ( $classes as $classe )
                      @if ($classe->id == $classe_active->classe_id)
                        @foreach ( $classe->cours as $cours )
                          @php
                            $maxiPer += $cours->max_periode;
                            $maxExam += $cours->max_examen;
                          @endphp
                          {{$maxiPer}}
                        @endforeach
                        
                      @endif
                    @endforeach
                    <tr>
                      <th scope="row">
                        MAXIMA GENERAUX
                      </th>
                      <th>
                        {{$maxiPer}}
                      </th>
                      <th>
                        {{$maxiPer}}
                      </th>
                      <th>
                        {{$maxExam}}
                      </th>
                      <th>
                        {{ 2*$maxiPer + $maxExam}}
                      </th>
                      <th>
                        {{$maxiPer}}
                      </th>
                      <th>
                        {{$maxiPer}}
                      </th>
                      <th>
                        {{$maxExam}}
                      </th>
                      <th>
                        {{ 2*$maxiPer + $maxExam}}
                      </th>
                      <th>
                        {{ 4*$maxiPer + 2*$maxExam}}
                      </th>
                    </tr>

                    <tr>
                      <th scope="row">
                        TOTAUX
                      </th>
                      <td>
                        50
                      </td>
                      <td>
                        50
                      </td>
                      <td>
                        100
                      </td>
                      <td>
                        200
                      </td>
                      <td>
                        50
                      </td>
                      <td>
                        50
                      </td>
                      <td>
                        100
                      </td>
                      <td>
                        200
                      </td>
                      <td>
                        400
                      </td>
                    </tr>

                    <tr>
                      <th scope="row" class="text-left">
                        POURCENTAGE
                      </th>
                      <th>
                        50
                      </th>
                      <th>
                        50
                      </th>
                      <th>
                        100
                      </th>
                      <th>
                        200
                      </th>
                      <th>
                        50
                      </th>
                      <th>
                        50
                      </th>
                      <th>
                        100
                      </th>
                      <th>
                        200
                      </th>
                      <th>
                        400
                      </th>
                    </tr>
                  </tbody>
                </table>

            </div>
        </div>
      </div>
    </div>
  </div>
  
  @foreach ($classes as $classe )
    @if ($classe->id == $classe_active->classe_id)
      @foreach ($classe->cours as $cours )
          <div class="col-lg-6">
              <div class="card">
                  <div class="card-body">
                      <h5 class="card-title">{{$cours->nom}}</h5>

                      <!-- Accordion without outline borders -->
                      <div class="accordion accordion-flush" id="accordionFlushExample">
                      <div class="accordion-item">
                          <h2 class="accordion-header" id="flush-heading{{$cours->id}}">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$cours->id}}" aria-expanded="false" aria-controls="flush-collapse{{$cours->id}}">
                                  Détails
                              </button>
                          </h2>
                          <div id="flush-collapse{{$cours->id}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$cours->id}}" data-bs-parent="#accordionFlushExample">
                              <div class="accordion-body">
                                  <div class="row">
                                      <div class="col-lg-12">
                                          <div class="card-title">
                                            Total Cours : <span class="badge border-primary border-1 text-primary">{{$cours->maximum}}</span> | 
                                            Total Examen : <span class="badge border-primary border-1 text-primary">{{$cours->max_examen}}</span> | 
                                            Total Période : <span class="badge border-primary border-1 text-primary">{{$cours->max_periode}}</span>
                                          </div>
                                      </div>
                                  </div>

                                  <table class="table">
                                    <thead>
                                      <tr>
                                        <th scope="col">Période</th>
                                        <th scope="col">Global</th>
                                        <th scope="col">Moyenne</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($cours->archivedPeriode as $resultat)
                                        @foreach ($periodes as $periode )
                                          @if ($periode->id == $resultat->periode_id)
                                            @php
                                              $sommeCote = 0;
                                              $sommeMax = 0;
                                            @endphp
                                            @foreach ( $eleve->hasCote as $index => $lesCotes)
                                              @if (($lesCotes->cours_id == $cours->id) && ($lesCotes->periode->id == $resultat->periode_id))
                                                @php
                                                  $sommeCote += $lesCotes->cote;
                                                  $sommeMax += $lesCotes->max;
                                                @endphp
                                              @endif
                                            @endforeach
                                            
                                            @if (round($sommeCote) < ($sommeMax/2))
                                              <tr class="table-danger" data-toggle="tooltip" data-placement="right" title="Moyenne arrondie à 0.5">
                                                <th scope="row">{{$periode->nom}}</th>
                                                <td>{{$sommeCote}} / {{$sommeMax}}</td>
                                                <td> {{ round(($sommeCote * $cours->max_periode)/ $sommeMax)}} / {{$cours->max_periode}}</td>
                                              </tr>
                                            @else
                                              <tr class="table-success">
                                                <th scope="row">{{$periode->nom}}</th>
                                                <td>{{$sommeCote}} / {{$sommeMax}}</td>
                                                <td> {{ round(($sommeCote * $cours->max_periode)/ $sommeMax)}} / {{$cours->max_periode}}</td>
                                              </tr>
                                            @endif
                                          @endif
                                        @endforeach
                                      @endforeach
                                    </tbody>
                                  </table>
                                  <hr>
                                  <table class="table table-bordered table-striped datatable">
                                      <thead>
                                        <tr>
                                          <th scope="col">Période</th>
                                          <th scope="col">Epreuve</th>
                                          <th scope="col">Cote</th>
                                          <th scope="col">Max</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                          @foreach ( $eleve->hasCote as $index => $lesCotes )
                                              @if ($lesCotes->cours_id == $cours->id)
                                                  <tr>
                                                      <td>{{$lesCotes->periode->nom}}</td>
                                                      <td>{{$lesCotes->epreuve->nom}}</td>
                                                      <td>{{$lesCotes->cote}}</td>
                                                      <td>{{$lesCotes->max}}</td>
                                                  </tr>
                                              @endif
                                          @endforeach
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                      </div><!-- End Accordion without outline borders -->
                  </div>
              </div>
          </div>
      @endforeach
    @endif
    
  @endforeach
    
</section>
@endsection