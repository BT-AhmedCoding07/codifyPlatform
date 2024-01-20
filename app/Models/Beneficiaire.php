<?php

namespace App\Models;

use App\Models\User;
use App\Models\Chambre;
use App\Models\Reclamation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Beneficiaire extends Model
{
    use HasFactory;
    protected $fillable = [
        'etudiants_id',
        'chambres_id',
        'date_debut',
        'date_fin',
    ];

    public function chambres(){
        return $this->belongsTo(Chambre::class);
    }

    public function etudiants(){
        return $this->belongsTo(User::class);
    }


    public function reclamations(){
        return $this->hasMany(Reclamation::class);
    }
}
