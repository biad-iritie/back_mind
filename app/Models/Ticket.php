<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'evenement_id','categ_tick', 'prix_tick','nbre_tick', 
        'qte_ini_tick','qte_rest_tick'
    ];

    public function evenement(){
        return $this->belongsTo(Evenement::class);
    }
}
