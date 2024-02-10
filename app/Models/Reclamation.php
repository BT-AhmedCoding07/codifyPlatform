<?php

namespace App\Models;

use App\Models\Chambre;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reclamation extends Model
{
    use HasFactory;
    protected $fillable = [
        'objet',
        'message',
        'etudiants_id'
    ];



    public function etudiants()
    {
        return $this->belongsTo(Etudiant::class, "etudiants_id");
    }
}
