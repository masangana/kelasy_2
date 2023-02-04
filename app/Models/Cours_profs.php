<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours_profs extends Model
{
    use HasFactory;

    protected $fillable = [
        'cours_id',
        'user_id',
        'annee_scolaire_id',
    ];

    public function cours()
    {
        return $this->belongsTo(Cours::class);
    }

    public function professeur()
    {
        return $this->belongsTo(User::class);
    }

    public function cursus()
    {
        return $this->belongsTo(Cursus::class);
    }

    public function isActive()
    {
        return $this->is_active;
    }   
}
