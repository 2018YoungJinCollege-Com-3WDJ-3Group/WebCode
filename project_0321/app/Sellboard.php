<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sellboard extends Model
{
    protected $table='sellboard';
    //
    public static $rules=[
        'title'=>'required',
        'body'=>'required',
        'price'=>'Integer'
    ];
    
}