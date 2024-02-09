<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChambreRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'libelle' =>  $this->libelle,
            'type_chambre'=> $this->type_chambre,
            'nombres_lits'=>$this->nombres_lits,
            'nombres_limites'=>$this->nombres_limites,
            'pavillon' =>$this->pavillons->libelle
        ];
    }
}
