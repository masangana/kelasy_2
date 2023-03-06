<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'slug',
        'description',
        'maximum',
        'classe_id',
        'max_examen',
        'max_periode',
    ];
    
    public function classe()
    {
        return $this->belongsTo(Classe::class, 'classe_id');
    }

    public function getNomAttribute($value)
    {
        return ucfirst($value);
    }

    public function professeurs()
    {
        return $this->belongsToMany(User::class, 'cours_profs')
            ->withPivot('cours_id', 'user_id', 'annee_scolaire_id')
            ->withTimestamps();
    }

    public function archivedPeriode()
    {
        $annee = AnneeScolaire::where('active', 1)->first();
        return $this->hasMany(ArchiveCote::class)
            ->where('annee_scolaire_id', $annee->id);
    }
}
