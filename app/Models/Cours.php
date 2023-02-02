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
        return $this->belongsToMany(User::class, 'cours_profs');
    }
}
