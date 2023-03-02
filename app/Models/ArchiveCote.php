<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchiveCote extends Model
{
    use HasFactory;

    protected $fillable = [
        'cours_id',
        'classe_id',
        'periode_id',
        'annee_scolaire_id',
        'completed',
    ];

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    public function cours()
    {
        return $this->belongsTo(Cours::class);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
    
}
