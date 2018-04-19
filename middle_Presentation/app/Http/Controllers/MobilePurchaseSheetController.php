<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Purchase;


class MobilePurchaseSheetController extends Controller
{
    //

    public function PurchaseSheet(Request $request)
    {

        $sheetArray = array();
        $user_id = $request->get('user_id');

        $score_id = DB::table('purchase')->select('score_id')
            ->where('user_id','=',$user_id)
            ->get();

        for($i=0; $i<sizeof($score_id); $i++){
            $sheet = DB::table('score')->select('score_id');
            $sheets = $sheet
                ->addselect('writer')
                ->addselect('title')
                ->addselect('category')
                ->addselect('comment')
                ->addselect('scorestring')
                ->addselect('thumnail')
                ->addselect('created_at')
                ->addselect('updated_at')
                ->where('score_id','=',$score_id[$i]->score_id)
                ->get();
            array_push($sheetArray,$sheets);
        }
        return array_flatten($sheetArray);
    }

}