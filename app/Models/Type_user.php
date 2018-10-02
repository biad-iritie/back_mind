<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type_user extends Model
{
    //

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'lib_tuser',
    ];
}
