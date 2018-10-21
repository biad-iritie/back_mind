<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket_buy extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = [
        'id','user_id', 'ticket_id','event_id', 'receveur_id','numero_transaction','qrcode',
        'statut'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}
