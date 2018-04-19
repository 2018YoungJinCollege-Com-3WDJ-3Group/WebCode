<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    //
    protected $table='purchase';
     protected $primaryKey  = 'user_id';
     
     public function scores()
    {
        return $this->hasOne('App\Score','score_id');
    }
}
