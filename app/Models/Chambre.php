<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chambre extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
        'type_chambre',
        'password',
        'nombres_lits',
        'pavillons_id'
    ];

    public function etudiants(){
        return $this->hasMany(Etudiant::class);
    }

    public function pavillons()
    {
        return $this->belongsTo(Pavillon::class);
    }
}
