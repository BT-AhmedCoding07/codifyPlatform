<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'prenom'  =>  $this->prenom,
            'nom' =>  $this->nom,
            'email' =>  $this->email,
            'telephone' =>  $this->telephone,
            'role' =>  $this->role ?  $this->role->nomRole : null
        ];

    }
}
