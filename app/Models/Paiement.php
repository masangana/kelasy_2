<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'eleve_id',
        'personnel_id',
        'motif_id',
        'montant',
        'annee_scolaire_id',
        'description',
        'numero',
    ];

    public function eleve()
    {
        return $this->belongsTo(User::class, 'eleve_id')
            ->with('personne', 'classeParAnnee');
    }

    public function personnel()
    {
        return $this->belongsTo(User::class, 'personnel_id')
            ->with('personne');
    }

    public function motif()
    {
        return $this->belongsTo(Motif::class);
    }

    public function annee_scolaire()
    {
        return $this->belongsTo(AnneeScolaire::class);
    }

    public function eleveParAnnee(){
        $annee = AnneeScolaire::where('active', 1)->first();
        return $this->belongsTo(User::class, 'eleve_id')->where('annee_scolaire_id', $annee);
    }
}
