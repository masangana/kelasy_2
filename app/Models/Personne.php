<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personne extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'postnom',
        'prenom',
        'email',
        'telephone',
        'adresse',
        'date_naissance',
        'lieu_naissance',
        'sexe',
        'photo',
        'ecole_id',
        'user_id',
    ];

    protected $dates = [
        'date_naissance',
    ];

    public function ecole()
    {
        return $this->belongsTo(Ecole::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getFullNameAttribute()
    {
        return "{$this->nom} {$this->prenom} {$this->postnom} ";
    }

    public function getAgeAttribute()
    {
        return $this->date_naissance->diffInYears(now());
    }

    public function getSexeAttribute($value)
    {
        return $value == 'M' ? 'Masculin' : 'Féminin';
    }

    public function getPhotoAttribute($value)
    {
        return $value ?? 'default.png';
    }

    public function age()
    {
        return Carbon::parse($this->attributes['date_naissance'])->age;
    }
}
