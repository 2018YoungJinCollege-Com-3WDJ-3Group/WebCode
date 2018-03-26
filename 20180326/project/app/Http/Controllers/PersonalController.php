<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; 
use App\Score;
use App\Retain;
class PersonalController extends Controller
{
    //
    
    
    public function getScore(){
        $user_id=session()->get('user_id');
        $retains = DB::table('retain')->where('user_id', $user_id)->get();
        $array=array();
        foreach($retains as $datas){
            $score=Score::find($datas->score_id);
            array_push($array,$score);
        }
         //$json=json_encode($array);
        return view('user.score',compact('array'));
    }
}
