<?php

namespace App\Models;

use App\Models\Chambre;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Etudiant extends Model
{
    use HasFactory;
    protected $fillable = [
        'INE',
        'date_naissance',
        'lieu_naissance',
        'adresse',
        'sexe',
        'niveau_etudes',
        'filiere',
        'statuts_id',
        'users_id',
        'estAttribue',
    ];


    public function statuts()
    {
        return $this->belongsTo(Statut::class);
    }
    public function chambres()
    {
        return $this->hasMany(Chambre::class);
    }
}
