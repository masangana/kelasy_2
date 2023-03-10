<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'ecole_id',
        'role_id',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function personne()
    {
        return $this->hasOne(Personne::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function titulaire()
    {
        return $this->hasOne(Classe::class, 'professeur_id');
    }

    public function eleve()
    {
        return $this->belongsTo(Classe::class);
    }

    public function hasCours()
    {
        return $this->belongsToMany(Cours::class, 'cours_profs')
            ->withPivot('cours_id', 'user_id', 'annee_scolaire_id', 'is_active')
            ->where('is_active', 1)
            ->withTimestamps();
    }

    public function isPupil()
    {
        return $this->belongsToMany(Classe::class, 'classe_eleves', 'user_id', 'classe_id')
            ->withPivot('classe_id', 'user_id', 'annee_scolaire_id')
            ->withTimestamps();
    }

    public function hasCursus()
    {
        return $this->belongsToMany(Cursus::class, 'cursus_eleves');
    }

    public function hasCote(){
        return $this->hasMany(Cote::class, 'eleve_id');
    }

    public function hasCoteByCursus(){
        $annee = AnneeScolaire::where('active', 1)->first();
        return $this->hasMany(Cote::class, 'eleve_id')
            ->where('annee_scolaire_id', $annee->id);
    }

    public function classeParAnnee(){
        $annee = AnneeScolaire::where('active', 1)->first();
        return $this->belongsToMany(Classe::class, 'classe_eleves', 'user_id', 'classe_id')
            ->withPivot('classe_id', 'user_id', 'annee_scolaire_id')
            ->with('scolariteParAnnee')
            ->where('annee_scolaire_id', $annee->id);
    }

    public function scolarite(){
        $annee = AnneeScolaire::where('active', 1)->first();
        return $this->hasMany(Paiement::class, 'eleve_id')
            ->where('annee_scolaire_id', $annee->id)
            ->with('motif');
    }
}
