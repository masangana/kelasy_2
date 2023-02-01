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
        return $this->hasMany(Eleve::class);
    }

    public function tuteur()
    {
        return $this->hasMany(Tuteur::class);
    }    
}
