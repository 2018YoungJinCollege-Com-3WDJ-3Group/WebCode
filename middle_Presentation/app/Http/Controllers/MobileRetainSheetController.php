<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Retain;

class MobileRetainSheetController extends Controller
{
    //
    public function RetainSheet(Request $request)
    {

        $sheetArray = array();
        $user_id = $request->get('user_id');

        $score_id = DB::table('retain')->select('score_id')
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
