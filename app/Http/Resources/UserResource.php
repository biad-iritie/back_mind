<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UserResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'id_tuser' => $this->id_tuser,
            'nom_user' => $this->nom_user,
            'prenom_user' => $this->prenom_user,
            'numero_user' => $this->numero_user,
            'email' => $this->email
            ];
    }
}
