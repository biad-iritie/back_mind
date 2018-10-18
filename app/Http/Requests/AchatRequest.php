<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AchatRequest extends FormRequest
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
            'operateur_id' => 'required',
            'numero_achat' => 'required',
            'tickets' => 'required',
            /* 'ticket_id' => 'required',
            'nbr_ticket' => 'required',
            'montant_achat	' => 'required',
            'numero_achat' => 'required', */
        ];
    }
}
