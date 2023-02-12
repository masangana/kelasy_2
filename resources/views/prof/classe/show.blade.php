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

                  </p>
              </div>

              <div class="tab-pane fade pt-3" id="profile-settings">

                <!-- Settings Form -->
                <form>

                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                    <div class="col-md-8 col-lg-9">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="changesMade" checked>
                        <label class="form-check-label" for="changesMade">
                          Changes made to your account
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="newProducts" checked>
                        <label class="form-check-label" for="newProducts">
                          Information on new products and services
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="proOffers">
                        <label class="form-check-label" for="proOffers">
                          Marketing and promo offers
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                        <label class="form-check-label" for="securityNotify">
                          Security alerts
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End settings Form -->

              </div>

              <div class="tab-pane fade pt-3" id="profile-change-password">
                <!-- Change Password Form -->
                <form>

                  <div class="row mb-3">
                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="password" type="password" class="form-control" id="currentPassword">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="newpassword" type="password" class="form-control" id="newPassword">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                  </div>
                </form><!-- End Change Password Form -->

              </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
</section>
@endsection