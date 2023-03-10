
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <br>
          <form class="search-form d-flex align-items-center" action="{{route('finance.rapport')}}">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="date_filter" id="date_filter"/>
                </div>
                <div class="col-md-8">
                    <input type="submit"  class="btn btn-success" value="Filter" />
                </div>
          </form>
        </div>
      </div>

    </div>

    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Rapport Financier</h5>
          <br>
          <div class="row">
            <div class="table-responsive col-lg-4 col-md-6">
              <table class="table table-bordered">
                <thead>
                  <tr class="table-info">
                    <th scope="col" colspan="3" class="text-center">Général</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Nombre d'opération</th>
                    <td class="text-end"> {{$paiements->count()}}</td>
                  </tr>
                  <tr>
                    <th scope="row">Montant Total </th>
                    <td class="text-end">$ {{$paiements->sum('montant')}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="table-responsive col-lg-4 col-md-6">
              <table class="table table-bordered">
                <thead>
                  <tr class="table-success">
                    <th scope="col" colspan="3" class="text-center">Scolarité</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Nombre d'opération</th>
                    <td class="text-end"> {{$fraisScolaires->count()}}</td>
                  </tr>
                  <tr>
                    <th scope="row">Montant Total </th>
                    <td class="text-end">$ {{$fraisScolaires->sum('montant')}}</td>
                  </tr>
                </tbody>
              </table>
            </div>  
            <div class="table-responsive col-lg-4 col-md-6">
              <table class="table table-bordered">
                <thead>
                  <tr class="table-primary">
                    <th scope="col" colspan="3" class="text-center">Autres Frais</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Nombre d'opération</th>
                    <td class="text-end"> {{$autresFrais->count()}}</td>
                  </tr>
                  <tr>
                    <th scope="row">Montant Total </th>
                    <td class="text-end">$ {{$autresFrais->sum('montant')}}</td>
                  </tr>
                </tbody>
              </table>
            </div>  
          </div>
          
          <div class="table-responsive">
            <table class="table datatable table-striped table-bordered zero-configuration">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Eleve</th>
                  <th>Montant</th>
                  <th>Motif</th>
                  <th>Numero</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($paiements as $index=> $paiement)
                  <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$paiement->eleve->personne->nom}} {{$paiement->eleve->personne->postnom}} {{$paiement->eleve->personne->prenom}}</td>
                    <td>{{$paiement->montant}}</td>
                    <td>{{$paiement->motif->nom}}</td>
                    <td>{{$paiement->numero}}</td>
                    <td>{{$paiement->created_at->format('d-m-Y')}}</td>
                  </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Eleve</th>
                  <th>Montant</th>
                  <th>Motif</th>
                  <th>Date</th>
                </tr>
              </tfoot>
            </table>

        </div>
      </div>

    </div>
  </div>
@endsection