<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EleveParent extends Model
{
    use HasFactory;

    protected $fillable = [
        'eleve_id',
        'parent_id',
    ];
    public function eleve()
    {
        return $this->belongsTo(User::class, 'eleve_id');
    }

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }
}
