
@extends('layouts.app')

@section('content')
<div class="row">

    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Rapport Par Classe</h5>
          <br>
          <div class="table-responsive">
            <table class="table datatable table-striped table-bordered zero-configuration">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nom</th>
                  <th>Minervals</th>
                  @foreach ($motifs as $motif )
                      <th>{{$motif->nom}}</th>
                  @endforeach
                </tr>
              </thead>
              <tbody>
                    @foreach ($classe->eleves as $index => $eleve )
                        <tr>
                            <th scope="row">{{$index + 1}}</th>
                            <td>
                                <a href="{{route('paiement.show', $eleve->id)}}">
                                    {{$eleve->personne->nom}} {{$eleve->personne->postnom}} {{$eleve->personne->prenom}}
                                </a>
                            </td>
                            <td>$ {{$eleve->fraisScolarite->sum('montant')}}</td>
                            @foreach ($motifs as $motif )
                                @if ($eleve->AutresFrais->count() == 0)
                                    <td>$ 0</td>
                                @else
                                    @foreach ($eleve->AutresFrais as $frais )
                                        @if ($frais->motif_id == $motif->id)
                                            <td>$ {{$frais->montant}}</td>
                                        @else
                                            <td>$ 0</td>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
              </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
@endsection