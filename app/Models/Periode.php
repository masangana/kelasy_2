<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'date_debut',
        'date_fin',
        'commentaire',
    ];

    public function groupeCotes()
    {
        $annee = AnneeScolaire::where('active', 1)->first();
        return $this->hasMany(GroupeCote::class)
            ->where('annee_scolaire_id', $annee->id);
    }

    public function EpreuveNumber(){
        return $this->groupeCotes->count();
    }
}
