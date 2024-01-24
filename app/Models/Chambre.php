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
        'nombres_lits',
        'pavillons_id',
        'nombres_limites',
        'etudiants_id'
    ];

    public function etudiants()
    {
        return $this->belongsTo(Etudiant::class);
    }
    public function pavillons()
    {
        return $this->belongsTo(Pavillon::class);
    }
}
