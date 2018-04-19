<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Score;
class MobileShareScoreController extends Controller
{

   public function ShareScore(Request $request)
    {
            $score_id = $request->get('score_id');
            $scoreQuery = DB::table('score')->select('score_id');
            $score=$scoreQuery
                ->addSelect('writer')
                ->addSelect('title')
                ->addSelect('category')
                ->addSelect('comment')
                ->addSelect('scorestring')
                ->addSelect('thumnail')
                ->addSelect('created_at')
                ->where('score_id','=',$score_id)
                ->get();

            return json_encode($score);

    }
}