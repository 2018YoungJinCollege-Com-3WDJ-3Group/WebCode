<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    //
    protected $table='score';
    protected $primaryKey  = 'num';
    
    public function latestuploadid()
    {
        $posts=score::orderby('created_at','desc')->first();
        return $posts->id;
    }
     public function retains()
    {
        return $this->belongsTo('App\Retain');
    }
}
