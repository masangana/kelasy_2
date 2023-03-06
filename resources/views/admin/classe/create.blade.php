@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-2">
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Ajouter Une Classe</h5>
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
              <form method="POST" action="{{Route('classes.store')}} ">
                  @csrf
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Nom</label>
                  <div class="col-sm-10">
                    <input type="text"
                           class="form-control"
                           name="nom"
                           required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Slug</label>
                  <div class="col-sm-10">
                    <input type="text"
                           class="form-control"
                           required
                           name="slug">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Prof</label>
                  <div class="col-sm-10">
                    <select class="form-select"
                            aria-label="Default select example"
                            name="prof"
                            id="prof"
                            required>
                          <option selected value="">Choisir un prof</option>
                          @foreach ($profs as $prof)
                            @if ($prof->personne)
                              <option value="{{$prof->id}} ">
                                {{$prof->name}} {{$prof->personne->postnom}}
                              </option>
                            @endif
                            
                          @endforeach
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Niveau</label>
                  <div class="col-sm-10">
                    <select class="form-select"
                            aria-label="Default select example"
                            name="niveau"
                            required>
                        <option selected value="Primaire">Primaire</option>
                        <option value="Secondaire">Secondaire</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Desciprion</label>
                  <div class="col-sm-10">
                    <textarea class="form-control"
                              style="height: 100px"
                              name="description"></textarea>
                  </div>
                </div>
  
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                  </div>
                </div>
  
              </form><!-- End General Form Elements -->
  
            </div>
          </div>
    </div>
    <div class="col-lg-2">
    </div>
</div>
@endsection