<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnneeScolaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'date_debut',
        'date_fin',
        'description',
    ];

    protected $dates = [
        'date_debut',
        'date_fin',
    ];

    public function getNomAttribute($value)
    {
        return ucfirst($value);
    }

    public function getDates()
    {
        return ['date_debut', 'date_fin'];
    }

    public function getDatesAttribute($value)
    {
        return $this->attributes['date_debut'] = $value;
    }
}
