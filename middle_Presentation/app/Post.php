<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $primaryKey  = 'post_id';
    protected $table='post';
    //규칙 정의
    public static $rules=[
        'title'=>'required',
        'body'=>'required',
         'category'=>'required'
        
    ];
}
