
@extends('layouts.app')

@section('content')
<section class="section profile">
  <div class="row">
    <div class="col-xl-4">

      <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

          <img src="{{asset("images/personnes/".$personne->photo)}}" alt="Profile" class="rounded-circle">
          <h2>{{$personne->prenom}} {{$personne->nom}} </h2>
          <h3>{{$personne->profession}}</h3>
          
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
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
            </li>
            @if (Auth::user()->role == 'groupe')
              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
              </li>
            @endif
          </ul>
          <div class="tab-content pt-2">

            <div class="tab-pane fade show active profile-overview" id="profile-overview">
             
              <h5 class="card-title"> Détails Du Profile</h5>

              <div class="row">
                <div class="col-lg-6">
                  <div class="col-lg-3 col-md-4 label ">Nom</div>
                  <div class="col-lg-9 col-md-8"> {{$personne->nom}} {{$personne->postnom}} {{$personne->prenom}} </div>
                </div>

                <div class="col-lg-6">
                  <div class="col-lg-6 col-md-4 label">Genre</div>
                  <div class="col-lg-6 col-md-8">{{$personne->sexe =='M' ? 'Masculin' : 'Feminin'}}</div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="col-lg-6 col-md-4 label">Lieu de Naissance</div>
                  <div class="col-lg-6 col-md-8">{{$personne->lieu_naissance}}</div>
                </div>
                <div class="col-lg-6">
                  <div class="col-lg-6 col-md-4 label">Date de Naissance</div>
                  <div class="col-lg-6 col-md-8">{{$personne->date_naissance->format('d/m/Y')}}</div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-lg-6">
                    <div class="col-lg-6 col-md-4 label">Téléphone</div>
                    <div class="col-lg-6 col-md-8">{{$personne->telephone}}</div>
                </div>
                <div class="col-lg-6">
                  <div class="col-lg-6 col-md-4 label">Adresse</div>
                  <div class="col-lg-6 col-md-8">{{$personne->adresse}}</div>
                </div>
              </div>
             
              <div class="row">
                <div class="col-lg-6">
                  <div class="col-lg-6 col-md-4 label">E-mail</div>
                  <div class="col-lg-6 col-md-8">{{$personne->email}}</div>
                </div>
                
              </div>
             
            </div>
          </div><!-- End Bordered Tabs -->

        </div>
      </div>

    </div>

            @if ($personne->user->role == 'eleve' && sizeof($personne->user->isPupil) != 0)
              @foreach ($annees as $index => $cursus )
              
                <div class="col-xl-12">

                  <div class="card">
                    <div class="card-body pt-3">
                      <!-- Bordered Tabs -->
                      <div class="tab-content pt-2">

                          <div class="accordion accordion-flush" id="accordionFlushExample{{$cursus->id}}">
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="flush-heading{{$cursus->id}}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$cursus->id}}" aria-expanded="false" aria-controls="flush-collapse{{$cursus->id}}">
                                  {{$cursus->nom}}
                                </button>
                              </h2>
                              <div id="flush-collapse{{$cursus->id}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$cursus->id}}" data-bs-parent="#accordionFlushExample{{$cursus->id}}">
                                <div class="accordion-body">
                                  @foreach ($personne->user->isPupil as $classe)
                                    @if ($classe->pivot->annee_scolaire_id == $cursus->id)
                                      {{$classe0->nom}}
                                    @endif
                                  @endforeach
                                </div>
                              </div>
                            </div>
                          </div>
                        </div><!-- End Bordered Tabs -->

                      </div>
                    </div>
              
                </div>
              @endforeach
            @endif
            
          

  </div>
</section>
@endsection