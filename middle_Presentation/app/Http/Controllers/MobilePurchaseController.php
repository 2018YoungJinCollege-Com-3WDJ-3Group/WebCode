<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Purchase;
use App\User;
use App\Sharepost;

class MobilePurchaseController extends Controller
{

    public function purchase(Request $request){

        $post_id = $request->get('post_id');
        $user_id = $request->get('user_id');
        $score_id = $request->get('score_id');
       $check=DB::table('purchase')->where([['user_id', $user_id],['score_id',$score_id]])->exists();
        $userPoint=DB::table('users')->where('id',$user_id)->value('point');
        $price=DB::table('sharepost')->where('score_id',$score_id)->value('price');
        if($check==false){
            if($price<=$userPoint){

                DB::table('users')->where('id',$user_id)->decrement('point',(int)$price);
                DB::table('sharepost')->where('post_id',$post_id)->increment('count',1);
                $purchaseDB = new Purchase();
                $purchaseDB->user_id=$user_id;
                $purchaseDB->score_id=$score_id;
                $purchaseDB->save();
                $save=array('check'=>'save');
                return  json_encode($save);
            }
            else{
                $save=array('check'=>'pointFail');
                return json_encode($save);
            }
        }
        else{
            $save=array('check'=>'false');
            return  json_encode($save);
        }

    }

}
