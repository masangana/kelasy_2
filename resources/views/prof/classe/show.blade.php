@extends('layouts.app')

@section('content')
<div class="pagetitle">
    <h1>{{$classe->nom}} </h1>
</div><!-- End Page Title -->

<section class="section profile">
    <div class="row">
      <div class="col-xl-12">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Globale</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Cote</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">
        
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  Bienvenue. Vous etes le professeur responsable de cette classe. Vous trouverez sur cette page,
                   La liste des eleves et les professeur qui dispensent les cours!

                   <br>
                   Cliquez sur le nom d'un eleve pour avoir plus d'information.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <h5 class="card-title">Eleves</h5>

                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Eleve</th>
                      <th scope="col">Genre</th>
                      <th scope="col">Age</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($classe->eleves as $index => $eleve )
                    <tr>
                      <th scope="row">{{$index+1}}</th>
                      <td>
                        <a href="{{route('eleve.show', $eleve->id)}}">
                          {{$eleve->personne->nom}} {{$eleve->personne->postnom}} {{$eleve->personne->prenom}}
                        </a>
                      </td>
                      <td>{{$eleve->personne->sexe}}</td>
                      <td>{{$eleve->personne->age()}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>

                <h5 class="card-title">Professeurs</h5>

                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Professeur</th>
                      <th scope="col">Genre</th>
                      <th scope="col">Cours</th>
                      <th scope="col">Téléphone</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($cours as $index => $unCours )
                      @foreach ($unCours->professeurs as $index => $professeur )
                        <tr>
                          <th scope="row">{{$index+1}}</th>
                          <td>{{$professeur->personne->nom}} {{$professeur->personne->postnom}} {{$professeur->personne->prenom}}</td>
                          <td>{{$professeur->personne->sexe}}</td>
                          <td>{{$unCours->nom}}</td>
                          <td>{{$professeur->personne->telephone}}</td>
                        </tr>
                      @endforeach
                    @endforeach
                  </tbody>
                </table>

              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                  <p>
                    Les résultats de la classe
                  </p>

                  <table class="table datatable table-striped">
                    <thead>
                      <tr>
                        <th scope="col">Eleve</th>
                        <th scope="col">Genre</th>
                        <th scope="col">1re P</th>
                        <th scope="col">2e P</th>
                        <th scope="col">Examen</th>
                        <th scope="col">Total Semestre</th>
                        <th scope="col">3e P</th>
                        <th scope="col">4e P</th>
                        <th scope="col">Examen</th>
                        <th scope="col">Total Semestre</th>
                        <th scope="col">Total Année</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($classe->eleves as $index => $eleve )
                          @php
                              $totalP1 = [];
                              $totalP2 = [];
                              $totalP3 = [];
                              $totalP4 = [];
                              $totalExam2 = [];
                              $totalExam1 = [];
                              $totalGen = [];
                              $maxiPer = 0;
                              $maxExam = 0;
                              $maxGen = 0;
                              $archived1 = 0;
                              $archived2 = 0;
                              $archived3 = 0;
                          @endphp
                          
                          @foreach ( $classe->cours as $cours )
                              @php
                                  $p1 = "";
                                  $p2 = "";
                                  $p3 = "";
                                  $p4 = "";
                                  $exam1 = "";
                                  $exam2 = "";
                                  $maxiPer += $cours->max_periode;
                                  $maxExam += $cours->max_examen;
                              @endphp
                              @foreach ( $cours->archivedPeriode as $resultat )
                                  @foreach ($periodes as $periode )
                                      @php
                                          $sommeCote = 0;
                                          $sommeMax = 0;
                                      @endphp
                                      @if ($resultat->periode_id == $periode->id)
                                      
                                          @foreach ( $eleve->hasCoteByCursus as $index => $lesCotes)
                                              @if (($lesCotes->cours_id == $cours->id) && ($lesCotes->periode->id == $resultat->periode_id))
                                                @php
                                                    $sommeCote += $lesCotes->cote;
                                                    $sommeMax += $lesCotes->max;
                                                @endphp
                                              @endif
                                          @endforeach
                                          
                                          @if ($periode->nom == 'Première Période' )
                                              @php
                                                $p1 = round(($sommeCote * $cours->max_periode)/ $sommeMax);
                                              @endphp
                                          @endif
                                          
                                          @if ($periode->nom == 'Deuxième Période' )
                                              @php
                                                $p2 = round(($sommeCote * $cours->max_periode)/ $sommeMax);
                                              @endphp
                                          @endif
              
                                          @if ($periode->nom == 'Troisième Periode' )
                                              @php
                                                $p3 = round(($sommeCote * $cours->max_periode)/ $sommeMax)
                                              @endphp
                                          @endif
              
                                          @if ($periode->nom == 'Quatrième Periode' )
                                              @php
                                              $p4 = round(($sommeCote * $cours->max_periode)/ $sommeMax)
                                              @endphp
                                          @endif
              
                                          @if ($periode->nom == 'Premier Semestre' )
                                              @php
                                              $exam1 = round(($sommeCote * $cours->max_examen)/ $sommeMax)
                                              @endphp
                                          @endif
                                          
                                          @if ($periode->nom == 'Deuxième Semestre' )
                                              @php
                                              $exam2 = round(($sommeCote * $cours->max_examen)/ $sommeMax)
                                              @endphp
                                          @endif
                                      @endif
                                      
                                  @endforeach
                              @endforeach
                              @php
                                  $totalP1[] = $p1;
                                  $totalP2[] = $p2;
                                  $totalP3[] = $p3;
                                  $totalP4[] = $p4;
                                  $totalExam1[] = $exam1;
                                  $totalExam2[] = $exam2;
                              @endphp
                          @endforeach
                          
                          @php
                              $totalP1 = array_sum($totalP1);
                              $totalP2 = array_sum($totalP2);
                              $totalExam1 = array_sum($totalExam1);
                              $totalGen1 = $totalP1 + $totalP2 + $totalExam1;
                              $totalP3 = array_sum($totalP3);
                              $totalP4 = array_sum($totalP4);
                              $totalExam2 = array_sum($totalExam2);
                              $totalGen2 = $totalP3 + $totalP4 + $totalExam2;
                              $totalGen = $totalGen1 + $totalGen2;
                              $pourcentageP1 = $totalP1 * 100 / $maxiPer;
                              $pourcentageP2 = $totalP2 * 100 / $maxiPer;
                              $pourcentageExam1 = $totalExam1 * 100 / $maxExam;
                              $pourcentageGen1 = $totalGen1 * 100 / ($maxiPer + $maxiPer + $maxExam);
                              $pourcentageP3 = $totalP3 * 100 / $maxiPer;
                              $pourcentageP4 = $totalP4 * 100 / $maxiPer;
                              $pourcentageExam2 = $totalExam2 * 100 / $maxExam;
                              $pourcentageGen2 = $totalGen2 * 100 / ($maxiPer + $maxiPer + $maxExam);
                              $pourcentageGen = $totalGen * 100 / (2*$maxiPer + $maxExam + 2*$maxiPer + $maxExam);
                          @endphp
                          
                          <tr>
                            <td>
                              <a href="{{route('eleve.show', $eleve->id)}}">
                                {{$eleve->personne->nom}} {{$eleve->personne->postnom}} {{$eleve->personne->prenom}}
                              </a>
                            </td>
                            <td class="text-center">
                              @if ($eleve->personne->sexe == "Masculin")
                                M
                              @else
                                F
                              @endif
                            </td>
                            <td class="text-center">
                              {{round($pourcentageP1, 1)}}%
                            </td>
                            <td class="text-center">{{round($pourcentageP2, 1)}}%</td>
                            <td class="text-center">
                              {{round($pourcentageExam1, 1)}}%
                            </td>
                            <td class="text-center">
                              {{round($pourcentageGen1, 1)}}%
                            </td>
                            <td class="text-center">{{round($pourcentageP3, 1)}}%</td>
                            <td class="text-center">{{round($pourcentageP4, 1)}}%</td>
                            <td class="text-center">{{round($pourcentageExam2, 1)}}%</td>
                            <td class="text-center">{{round($pourcentageGen2, 1)}}%</td>
                            <td class="text-center">{{round($pourcentageGen, 1)}}%</td>
                          </tr>
                      @endforeach
                    </tbody>
                  </table>
              </div>
            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
</section>
@endsection