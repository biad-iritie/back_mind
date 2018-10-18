<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class EvenementResource extends Resource
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
            'type_event_id' => $this->type_event_id,
            'lib_event' => $this->lib_event,
            'description_event' => $this->description_event,
            'lieu_event' => $this->lieu_event,
            'datedebut_event' => $this->datedebut_event,
            'datefin_event' => $this->datefin_event,
            'heuredebut_event' => $this->heuredebut_event,
            'heurefin_event' => $this->heurefin_event,
            'image_event' => $this->image_event,
            'tickets' => $this->tickets,
            ];
    }
}
