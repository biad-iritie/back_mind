<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modif_ticket extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'ticket_id','date_modtick','prix_modtick','qteant_modtick','qtenew_modtick'
    ];
}
