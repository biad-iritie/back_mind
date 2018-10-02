<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achat extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'operateur_id','ticket_id','nbr_ticket',
         'date_achat', 'montant_achat	', 'numero_achat','numero_transaction','status_achat'
    ];
}
