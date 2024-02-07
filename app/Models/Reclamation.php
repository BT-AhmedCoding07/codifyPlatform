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
        'chambres_id'
    ];



    public function chambres()
    {
        return $this->belongsTo(Chambre::class, "chambres_id");
    }
}
