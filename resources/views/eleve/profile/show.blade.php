
@extends('layouts.app')

@section('content')
<section class="section profile">
    <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="{{asset("images/personnes/".$user->personne->photo)}}" alt="Profile" class="rounded-circle">
              <h2>{{$user->personne->prenom}} {{$user->personne->nom}} {{$user->personne->postnom}}</h2>
              <h3 class="text-capitalize">{{$user->role}}</h3>
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
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Tuteur</button>
                </li>
              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">Profile</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Noms</div>
                    <div class="col-lg-9 col-md-8">{{$user->personne->prenom}} {{$user->personne->nom}} {{$user->personne->postnom}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Classe</div>
                    <div class="col-lg-9 col-md-8">{{$classe_active->classe->nom}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Lieu de Naissance</div>
                    <div class="col-lg-9 col-md-8">{{$user->personne->lieu_naissance}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Date de Naissance</div>
                    <div class="col-lg-9 col-md-8">{{$user->personne->date_naissance->format('d-m-Y')}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Addresse</div>
                    <div class="col-lg-9 col-md-8">{{$user->personne->adresse}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8">{{$user->personne->telephone}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">{{$user->personne->email}}</div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit" id="profile-edit">

                  <h5 class="card-title">Profile</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Noms</div>
                    <div class="col-lg-9 col-md-8">{{$user->personne->prenom}} {{$user->personne->nom}} {{$user->personne->postnom}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Addresse</div>
                    <div class="col-lg-9 col-md-8">{{$user->personne->adresse}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8">{{$user->personne->telephone}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">{{$user->personne->email}}</div>
                  </div>                  

                </div>
              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
    </div>
    
</section>
@endsection