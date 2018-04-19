<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Sharepost;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class MoblieShareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //모바일 지원
    public function index($pageid=0){
        $pageid=Input::get('pageid');
        $pageid=0;
        $query=DB::table('sharepost')->select('post_id');
        $posts=$query
            ->addSelect('writer')
            ->addSelect('price')
            ->addSelect('category')
            ->addSelect('count')
            ->addSelect('title')
            ->addSelect('body')
            ->addSelect('created_at')
            ->where('post_id','>',(Int)$pageid-1)
            //->limit(20)
            ->get();

        return json_encode($posts);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function show(Request $request)
    {

        //
        $post_id = $request->get('post_id');
        $posts=sharepost::find($post_id);
        $shareScoreArray = array();
        if($posts==null)
            return "잘못된 경로입니다.";
        else{
            //share post
            $scoreId=DB::table('sharepost')->where('post_id',$post_id)->value('score_id');
            $share_post_id['post_id']=DB::table('sharepost')->where('post_id',$post_id)->value('post_id');
            array_push($shareScoreArray,$share_post_id);
            $brd_id['brd_id']=DB::table('sharepost')->where('post_id',$post_id)->value('brd_id');
            array_push($shareScoreArray,$brd_id);
            $writer['writer']=DB::table('sharepost')->where('post_id',$post_id)->value('writer');
            array_push($shareScoreArray,$writer);
            $score_id['score_id']=DB::table('sharepost')->where('post_id',$post_id)->value('score_id');
            array_push($shareScoreArray,$score_id);
            $price['price']=DB::table('sharepost')->where('post_id',$post_id)->value('price');
            array_push($shareScoreArray,$price);
            $category['category']=DB::table('sharepost')->where('post_id',$post_id)->value('category');
            array_push($shareScoreArray,$category);
            $count['count']=DB::table('sharepost')->where('post_id',$post_id)->value('count');
            array_push($shareScoreArray,$count);
            $like['like']=DB::table('sharepost')->where('post_id',$post_id)->value('like');
            array_push($shareScoreArray,$like);
            $title['title']=DB::table('sharepost')->where('post_id',$post_id)->value('title');
            array_push($shareScoreArray,$title);
            $body['body']=DB::table('sharepost')->where('post_id',$post_id)->value('body');
            array_push($shareScoreArray,$body);
            $created_at['created_at']=DB::table('sharepost')->where('post_id',$post_id)->value('created_at');
            array_push($shareScoreArray,$created_at);
            //score
            $score_scorestring['score_scorestring']=DB::table('score')->where('score_id',$scoreId)->value('scorestring');
            array_push($shareScoreArray,$score_scorestring);
            $score_thumnail['score_thumnail']=DB::table('score')->where('score_id',$scoreId)->value('thumnail');
            array_push($shareScoreArray,$score_thumnail);
            $score_title['score_title']=DB::table('score')->where('score_id',$scoreId)->value('title');
            array_push($shareScoreArray,$score_title);

            return json_encode($shareScoreArray);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
       

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        

    }
    public function search(Request $request){
       
    }
}
