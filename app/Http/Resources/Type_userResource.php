<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Type_userResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'lib_tuser' => $this->lib_tuser,
            ];
    }
}
