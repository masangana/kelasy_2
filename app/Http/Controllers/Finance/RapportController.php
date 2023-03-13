<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\AnneeScolaire;
use App\Models\Motif;
use App\Models\Paiement;
use Illuminate\Http\Request;

class RapportController extends Controller
{
    public function index()
    {
        $annee = AnneeScolaire::where('active', true)->first();
        $paiements = Paiement::with('eleve', 'personnel', 'motif', 'annee_scolaire')
            ->where('annee_scolaire_id', $annee->id)->orderBy('created_at', 'DESC')
            ->get();
        $motif = Motif::where('nom', 'Scolarité')->first();
        $fraisScolaires = Paiement::with('eleve', 'personnel', 'motif', 'annee_scolaire')
                        ->where('annee_scolaire_id', $annee->id)->orderBy('created_at', 'DESC')
                        ->where('motif_id', $motif->id)
                        ->get();
        $autresFrais = Paiement::with('eleve', 'personnel', 'motif', 'annee_scolaire')
                        ->where('annee_scolaire_id', $annee->id)->orderBy('created_at', 'DESC')
                        ->where('motif_id','!=', $motif->id)
                        ->get();
        
        return view('finance.rapport.index', [
            'paiements' => $paiements,
            'fraisScolaires' => $fraisScolaires,
            'autresFrais' => $autresFrais,
        ]);
    }

    public function create()
    {
        return view('finance.rapport.create');
    }

    public function rapport(Request $request)
    {
        if (isset($request->date_filter)) {
            $parts = explode(' - ' , $request->date_filter);
            $date_from = $parts[0];
            $date_to = $parts[1];
        }
        else{
            $date_from = null;
            $date_to = null;
        }

        $paiements =  Paiement::whereBetween('created_at', [$date_from." 00:00:00", $date_to." 23:59:59"])
                        ->orderBy('created_at', 'DESC')
                        ->get();
        $motif = Motif::where('nom', 'Scolarité')->first();

        $fraisScolaires = Paiement::whereBetween('created_at', [$date_from." 00:00:00", $date_to." 23:59:59"])
                        ->orderBy('created_at', 'DESC')
                        ->where('motif_id', $motif->id)
                        ->get();
        $autresFrais = Paiement::whereBetween('created_at', [$date_from." 00:00:00", $date_to." 23:59:59"])
                        ->orderBy('created_at', 'DESC')
                        ->where('motif_id','!=', $motif->id)
                        ->get();

        return view('finance.rapport.index', [
            'paiements' => $paiements,
            'fraisScolaires' => $fraisScolaires,
            'autresFrais' => $autresFrais,
        ]);
    }


}
