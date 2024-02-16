<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'mois',
        'etudiants_id'
    ];
    public function etudiants()
    {
        return $this->belongsTo(Etudiant::class,'etudiants_id');
    }
}
