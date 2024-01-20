<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'users_id'
    ];

    public function beneficiaires(){
        return $this->hasMany(Beneficiaire::class);
    }
}
