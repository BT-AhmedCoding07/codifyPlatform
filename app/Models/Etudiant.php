<?php

namespace App\Models;

use App\Models\User;
use App\Models\Chambre;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Etudiant extends Model
{
    use HasFactory;
    protected $attributes =[
        'estAttribue' => 0,
    ];
    protected $fillable = [
        'INE',
        'date_naissance',
        'lieu_naissance',
        'adresse',
        'sexe',
        'niveau_etudes',
        'filiere',
        'statuts_id',
        'users_id',
        'estAttribue',
        'performances',
        'chambres_id'
    ];


    public function statuts()
    {
        return $this->belongsTo(Statut::class, "statuts_id", "type");
    }
    public function chambres()
    {
        return $this->belongsTo(Chambre::class, 'chambres_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
    public function reclamations()
    {
        return $this->belongsTo(Reclamation::class);
    }
    public function payements()
    {
        return $this->hasMany(Payment::class);
    }
    public function scopeEstAttribue($query)
    {
            return $query->where('estAttribue', 0)->get();
    }
    public function getEstAttribueAttribute($attribute){

        return $this->getEstAttribueOptions()[$attribute];
    }

    public function getEstAttribueOptions(){
        return [
            '0' => 'Pas validé',
            '1' => 'Validé',
        ];
    }
}
