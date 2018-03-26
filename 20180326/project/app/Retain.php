<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retain extends Model
{
    
    
    //
     protected $table='retain';
     protected $primaryKey  = 'num';
     
     public function scores()
    {
        return $this->hasOne('App\Score','score_id');
    }
}
