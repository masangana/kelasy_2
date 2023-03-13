<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scolarite extends Model
{
    use HasFactory;

    protected $fillable = [
        'classe_id',
        'montant',
        'description',
        'annee_scolaire_id',
    ];

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function annee_scolaire()
    {
        return $this->belongsTo(AnneeScolaire::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    public function paiementsParAnnee(){
        $annee = AnneeScolaire::where('active', 1)->first();
        return $this->hasMany(Paiement::class)->where('annee_scolaire_id', $annee);
    }

    public function eleves()
    {
        return $this->belongsToMany(User::class, 'paiements', 'scolarite_id', 'eleve_id');
    }

    public function personnel(){
        return $this->belongsToMany(User::class, 'paiements', 'scolarite_id', 'eleve_id');
    }
}
