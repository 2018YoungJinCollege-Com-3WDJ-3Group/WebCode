<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    //
    protected $table='score';
    protected $primaryKey  = 'score_id';
    
   
     public function retains()
    {
        return $this->belongsTo('App\Retain');
    }
}
