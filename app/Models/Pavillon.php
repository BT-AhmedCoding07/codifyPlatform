<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pavillon extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
        'type_pavillon',
        'nombres_etages',
        'nombres_chambres'
    ];

    public function chambres()
    {
        return $this->hasMany(Chambre::class);
    }
}
