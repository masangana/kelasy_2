<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'slug',
        'niveau',
        'description',
        'professeur_id',
        'ecole_id',
    ];

    public function ecole()
    {
        return $this->belongsTo(Ecole::class);
    }

    public function getNomAttribute($value)
    {
        return ucfirst($value);
    }

    public function eleves()
    {
        return $this->belongsToMany(User::class, 'classe_eleves');
    }

    public function tuteur()
    {
        return $this->belongsTo(User::class, 'professeur_id');
    }    

    public function cours()
    {
        return $this->hasMany(Cours::class, 'classe_id');
    }

    public function scolariteParAnnee()
    {
        $annee = AnneeScolaire::where('active', 1)->first();
        return $this->hasOne(Scolarite::class, 'classe_id')
        ->where('annee_scolaire_id', $annee->id);
    }

    public function scolarites()
    {
        return $this->hasMany(Scolarite::class, 'classe_id');
    }
}
