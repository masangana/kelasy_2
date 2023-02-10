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
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Table with stripped rows</h5>
  
                <!-- Table with stripped rows -->
                <table class="table table-bordered datatable">
                  <thead>
                    <tr>
                      <th rowspan="2" scope="col">#</th>
                      <th rowspan="2" scope="col">Name</th>
                      <th colspan="3" scope="col" class="text-center">Période 1</th>
                      <th colspan="3" scope="col" class="text-center">Période 2</th>
                    </tr>
                    <tr>
                      <th scope="col">TP</th>
                      <th scope="col">Extn.</th>
                      <th scope="col">E-mail</th>
                      <th scope="col">TP</th>
                      <th scope="col">Extn.</th>
                      <th scope="col">E-mail</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>Brandon Jacob</td>
                      <td>Designer</td>
                      <td>28</td>
                      <td>2016-05-25</td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>Bridie Kessler</td>
                      <td>Developer</td>
                      <td>35</td>
                      <td>2014-12-05</td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td>Ashleigh Langosh</td>
                      <td>Finance</td>
                      <td>45</td>
                      <td>2011-08-12</td>
                    </tr>
                    <tr>
                      <th scope="row">4</th>
                      <td>Angus Grady</td>
                      <td>HR</td>
                      <td>34</td>
                      <td>2012-06-11</td>
                    </tr>
                    <tr>
                      <th scope="row">5</th>
                      <td>Raheem Lehner</td>
                      <td>Dynamic Division Officer</td>
                      <td>47</td>
                      <td>2011-04-19</td>
                    </tr>
                  </tbody>
                </table>
                <!-- End Table with stripped rows -->
  
              </div>
            </div>
        </div>
        <div class="overflow-scroll tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
          <table class="table datatable ">
            <thead>
              <tr>
                <th class="align-middle" rowspan="2" >#</th>
                <th class="align-middle" rowspan="2" >Nom </th>
                <th class="align-middle" rowspan="2" >Genre</th>
                @foreach ($periodeTable as $index => $periode)
                  @foreach ($periodes as $periode2)
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
      </div><!-- End Bordered Tabs -->

    </div>
  </div>
@endsection