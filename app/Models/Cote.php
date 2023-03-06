<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cote extends Model
{
    use HasFactory;

    protected $fillable = [
        'eleve_id',
        'cours_id',
        'epreuve_id',
        'max',
        'periode_id',
        'cote',
        'annee_scolaire_id',
        'commentaire',
        'groupe_cote_id',
    ];

    public function eleve()
    {
        return $this->belongsTo(User::class);
    }

    public function cours()
    {
        return $this->belongsTo(Cours::class);
    }

    public function epreuve()
    {
        return $this->belongsTo(Epreuve::class);
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    public function anneeScolaire()
    {
        return $this->belongsTo(AnneeScolaire::class);
    }
    
}
