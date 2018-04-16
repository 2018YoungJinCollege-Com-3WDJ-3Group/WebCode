<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; 
use App\Score;
use App\Retain;
class PersonalController extends Controller
{
    //
    public function myinfo(){
        return view('user.info');
    }
    
    public function getScore(){
        $retain=array();
       $purchase=array();
        $user_id=session()->get('user_id');
        $retains = DB::table('retain')->where('user_id', $user_id)->get();
        foreach($retains as $datas){
            $retains_score=Score::find($datas->score_id);
            array_push($retain,$retains_score);
        }
        $user_id=session()->get('user_id');
        $purchases = DB::table('purchase')->where('user_id', $user_id)->get();
        foreach($purchases as $datas){
            $purchases_score=Score::find($datas->score_id);
            array_push($purchase,$purchases_score);
        }
        return view('user.score',compact(['retain','purchase']));
    }
    public function ShowScore(){
        $retain=array();
       $purchase=array();
        $user_id=session()->get('user_id');
        $retains = DB::table('retain')->where('user_id', $user_id)->get();
        foreach($retains as $datas){
            $retains_score=Score::find($datas->score_id);
            array_push($retain,$retains_score);
        }
        $user_id=session()->get('user_id');
        $purchases = DB::table('purchase')->where('user_id', $user_id)->get();
        foreach($purchases as $datas){
            $purchases_score=Score::find($datas->score_id);
            array_push($purchase,$purchases_score);
        }
       
        //확인 창 
        $response = array(
            'status'    => 'success',
            'msg'       => '확인완료.',
            'retain'       => $retain,
            'purchase'       => $purchase
            
        );
        
        
        return \Response::json($response);   
    }
}
