<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $attributes =[
        'mois' => 1,
    ];
    protected $fillable = [
        'amount',
        'mois',
        'etudiants_id'
    ];
    public function etudiants()
    {
        return $this->belongsTo(Etudiant::class,'etudiants_id');
    }
    public function scopeMois($query)
    {
            return $query->where('mois', 1)->get();
    }
    public function getMoisAttribute($attribute){

        return $this->getMoisOptions()[$attribute];
    }

    public function getMoisOptions(){
        return [
            '1' => 'Janvier',
            '2' => 'Fèvrier',
            '3' => 'Mars',
            '4' => 'Avril',
            '5' => 'Mai',
            '6' => 'Juin',
            '7' => 'Juillet',
            '8' => 'Août',
            '9' => 'Septembre',
            '10' => 'Octobre',
            '11' => 'Novembre',
            '12' => 'Decembre',
        ];
    }
}
