<?php

namespace App\Models;

use App\Models\Etudiant;
use App\Models\Pavillon;
use App\Models\Reclamation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chambre extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
        'type_chambre',
        'nombres_lits',
        'pavillons_id',
        'nombres_limites'
    ];
    public function etudiants()
    {
        return $this->hasMany(Etudiant::class, "etudiants_id");
    }
    public function pavillons()
    {
        return $this->belongsTo(Pavillon::class,'pavillons_id');
    }


}
