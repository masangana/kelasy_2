<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupeCote extends Model
{
    use HasFactory;

    protected $fillable = [
        'cours_id',
        'periode_id',
        'epreuve_id',
        'annee_scolaire_id',
        'max',
        'commentaire',
    ];

    public function cours()
    {
        return $this->belongsTo(Cours::class);
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    public function epreuve()
    {
        return $this->belongsTo(Epreuve::class);
    }

    public function anneeScolaire()
    {
        return $this->belongsTo(AnneeScolaire::class);
    }

    public function cotes()
    {
        return $this->hasMany(Cote::class);
    }

    public function getMoyenneAttribute()
    {
        return $this->cotes->avg('cote');
    }
    
}
