<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EtudiantRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'prenom' =>  $this->users->prenom,
            'nom'=>$this->users->nom,
            'email'=>$this->users->email,
            'telephone'=>$this->users->telephone,
            'adresse'=>$this->adresse,
            'INE'=>$this->INE,
            'niveau_etudes'=>$this->niveau_etudes,
            'filiere' =>$this->filiere
        ];
    }
}
