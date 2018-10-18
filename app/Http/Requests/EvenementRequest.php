<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EvenementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required',
            'type_user_id' => 'required',
            'type_event_id' => 'required|max:255',
            'lib_event' => 'required|max:50',
            'description_event' => 'required|max:255',
            'lieu_event' => 'required|max:255',
            'image_event' => 'required|string',
            'datedebut_event' => 'required|date',
            'datefin_event' => 'required|date',
            'heuredebut_event' => 'required',
            'heurefin_event' => 'required',
            'tickets'=> 'required',
        ];
    }
}
