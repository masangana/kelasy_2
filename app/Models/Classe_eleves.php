<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe_eleves extends Model
{
    use HasFactory;

    protected $fillable = [
        'classe_id',
        'user_id',
        'annee_scolaire_id',
    ];

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'classe_id');
    }

    public function eleve()
    {
        return $this->belongsTo(User::class, 'user_id')
            ->with('personne');
    }

    public function anneeScolaire()
    {
        return $this->belongsTo(AnneeScolaire::class, 'annee_scolaire_id');
    }
}
