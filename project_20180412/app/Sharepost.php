<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sharepost extends Model
{
    //
    protected $table='sharepost';
    protected $primaryKey  = 'post_id';
     protected $fillable = [
        'price', 'title', 'title',
    ];
    //규칙 정의
    public static $rules=[
        'title'=>'required',
        'price'=>'required|numeric',
        'body'=>'required',
        
    ];
    
    
}
