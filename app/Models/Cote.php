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
    ];

    public function eleve()
    {
        return $this->belongsTo(User::class);
    }
}
