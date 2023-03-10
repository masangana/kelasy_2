<div class="card">
    <div class="card-body">
      <h5 class="card-title">Ajoute d'une personne</h5>
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
      <!-- Vertical Form -->
      <form class="row g-3" method="POST" action=" {{route("personne.store")}} " enctype="multipart/form-data">
        @csrf
        <div class="col-6">
          <label for="inputNanme4" class="form-label">Nom</label>
          <input type="text"
                 class="form-control" 
                 id="inputNanme4"
                 name="nom">
        </div>
        <div class="col-6">
          <label for="inputNanme4" class="form-label">Post-Nom</label>
          <input type="text"
                 class="form-control" 
                 id="inputNanme4"
                 name="postnom">
        </div>
        <div class="col-6">
          <label for="inputNanme4" class="form-label">Prénom</label>
          <input type="text"
                 class="form-control" 
                 id="inputNanme4"
                 name="prenom">
        </div>
        <div class="col-6">
          <label class="form-label">Role</label>
          <select class="form-select"
                  aria-label="Default select example"
                  name="role">
            <option selected>Select</option>
            @foreach ($roles as $role )
              <option value="{{$role->id}}">{{$role->nom}}</option>
            @endforeach
          </select>
        </div>
        <hr>
        <div class="col-6">
          <label for="inputEmail4" class="form-label">Email</label>
          <input type="email"
                 class="form-control" 
                 id="inputEmail4"
                 name="email">
        </div>
        <div class="col-6">
          <label for="inputNanme4" class="form-label">Téléphone</label>
          <input type="tel"
                 class="form-control" 
                 id="inputNanme4"
                 name="telephone">
        </div>
        <div class="col-6">
          <label for="inputAddress" class="form-label">Adresse</label>
          <input type="text"
                 class="form-control" 
                 id="inputAddress" 
                 placeholder="1234 Main St"
                 name="adresse">
        </div>
        @if ($roles[0]->nom == 'eleve')
          <div class="col-6">
            <label class="form-label">Classe</label>
            <select class="form-select"
                    aria-label="Default select example"
                    name="classe"
                    id="prof">
              <option selected>Select</option>
              @foreach ($classes as $classe )
                <option value="{{$classe->id}}">{{$classe->nom}}</option>
              @endforeach
            </select>
          </div>
        @endif
          
        <hr>
        <div class="col-6">
          <label for="inputNanme4" class="form-label">Lieu de Naissance</label>
          <input type="text"
                 class="form-control" 
                 id="inputNanme4"
                 name="lieu_naissance">
        </div>
        <div class="col-6">
          <label for="inputNanme4" class="form-label">Date de naissance</label>
          <input type="date"
                 class="form-control" 
                 id="inputNanme4"
                 name="date_naissance">
        </div>
        <div class="col-6">
          <label class="form-label">Genre</label>
          <select class="form-select"
                  aria-label="Default select example"
                  name="sexe">
            <option selected>Open this select menu</option>
            <option value="M">Masculin</option>
            <option value="F">Féminin</option>
          </select>
        </div>
        <div class="col-6">
          <label for="inputNumber" class="form-label">Photo</label>
          <input class="form-control"
                 type="file" 
                 id="formFile"
                 name="photo"
                 accept="image/*"
                 required>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
      </form><!-- Vertical Form -->

    </div>
</div>