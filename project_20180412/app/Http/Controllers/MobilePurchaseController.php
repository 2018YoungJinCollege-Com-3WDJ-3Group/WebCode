<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Purchase;
class MobilePurchaseController extends Controller
{

    public function purchase(Request $request){

        $user_id = $request->get('user_id');
        $score_id = $request->get('scoreId');
        $check=DB::table('purchase')->where([['user_id', $user_id],['score_id',$score_id]])->exists();

        if($check==false){
            $purchaseDB = new Purchase();
            $purchaseDB->user_id=$user_id;
            $purchaseDB->score_id=$score_id;
            $purchaseDB->save();
            $arr=array('save'=>true,'msg'=>'저장해쩌');
            return  json_encode($arr);
        }
        else{
            $arr=array('save'=>false,'msg'=>'중복구매 다메!');
            return  json_encode($arr);
        }
    }

}
