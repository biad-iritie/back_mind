<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Ticket;

class Evenement extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','user_id', 'type_event_id','lib_event', 'description_event','datedebut_event',
        'lieu_event', 
        'datefin_event','heuredebut_event', 'heurefin_event','image_event'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    public function tickets(){
        return $this->hasMany(Ticket::class);
    }
    protected $with = ['tickets'];
}
