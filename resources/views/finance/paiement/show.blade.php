
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
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Scolarité</button>
            </li>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Autres Frais</button>
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
                    {{$eleve->classeParAnnee[0]->nom}}
                </h5>
                <h5> <span class="badge bg-primary"></span></h5>
                <p>
                  {{$eleve->classeParAnnee[0]->scolariteParAnnee->description}}
                </p>

                @php
                    $total = 0;
                    $paye = 0;
                    $reste = 0;
                    foreach ($eleve->scolarite as $scolarite) {
                      if ($scolarite->motif->nom == "Scolarité") {
                        $paye += $scolarite->montant;
                      }
                    }
                    $reste = $eleve->classeParAnnee[0]->scolariteParAnnee->montant - $paye;

                @endphp
                <div  class="table-responsive col-lg-8 col-md-8">
                  <table class="table">
                    
                    <tbody>
                      <tr class="table-primary">
                        <th scope="row">Totalité</th>
                        <td class="text-end">{{$eleve->classeParAnnee[0]->scolariteParAnnee->montant}} $</td>
                      </tr>
                      <tr class="table-success">
                        <th scope="row">Payé</th>
                        <td class="text-end">{{$paye}} $</td>
                      </tr>
                      <tr class="table-danger">
                        <th scope="row">Reste</th>
                        <td class="text-end">{{$reste}} $</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">Motif</th>
                        <th scope="col">Montant</th>
                        <th scope="col">Numéro</th>
                        <th scope="col">Date</th>
                        <th scope="col">Commentaire</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($eleve->scolarite as $scolarite )
                          @if ( $scolarite->motif->nom == "Scolarité")
                            <tr>
                                <td>{{$scolarite->motif->nom}}</td>
                                <td>{{$scolarite->montant}} $</td>
                                <td>{{$scolarite->numero}}</td>
                                <td>{{$scolarite->created_at->format('d-m-Y')}}</td>
                                <td>{{$scolarite->description}}</td>
                            </tr>
                          @endif
                        @endforeach
                    </tbody>
                  </table>
                </div>

            </div>

            <div class="tab-pane fade pt-3" id="profile-settings">
              <div  class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">Motif</th>
                      <th scope="col">Montant</th>
                      <th scope="col">Date</th>
                      <th scope="col">Commentaire</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($eleve->scolarite as $autreFrais )
                          @if ( $autreFrais->motif->nom != "Scolarité")
                            <tr>
                                <td>{{$autreFrais->motif->nom}}</td>
                                <td>{{$autreFrais->montant}} $</td>
                                <td>{{$autreFrais->created_at->format('d-m-Y')}}</td>
                                <td>{{$autreFrais->description}}</td>
                            </tr>
                          @endif
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>

</section>
@endsection