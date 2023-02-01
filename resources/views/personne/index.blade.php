


    <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Post-Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Fonction</th>
                    <th scope="col">Mail</th>
                    <th scope="col">Téléphone</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($personnes as $index => $personne )

                          @if ($personne->personne)
                                <tr>
                                    <th scope="row"> {{$index+1}} </th>
                                    <td class="capitalize">
                                        <a href="{{Route('personne.show', $personne->personne )}} ">
                                        {{ $personne->name }} 
                                        </a>
                                    </td>
                                    <td>
                                        {{ $personne->personne->postnom }}
                                    </td>
                                    <td>
                                        {{ $personne->personne->prenom }}
                                    </td>
                                    <td>
                                        {{ $personne->role }}
                                    </td>
                                    <td>
                                        {{ $personne->email }}
                                    </td>
                                    <td>
                                        {{ $personne->personne->telephone }}
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('personne.show', $personne->id) }}"
                                                    disabled><i class="bx bx-edit-alt me-1" ></i> Voir</a
                                                >
                                                
            
                                                <form id="delete-form-{{ $personne->id }}" action="{{ route('personne.destroy', ['personne' => $personne->id]) }}" method="POST" class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
            
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                
                          @endif
                          
                  @endforeach
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
  
      