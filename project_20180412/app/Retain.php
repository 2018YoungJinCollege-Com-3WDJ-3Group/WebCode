<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retain extends Model
{
    
    
    //
     protected $table='retain';
     protected $primaryKey  = 'user_id';
     
     public function scores()
    {
        return $this->hasOne('App\Score','score_id');
    }
}
