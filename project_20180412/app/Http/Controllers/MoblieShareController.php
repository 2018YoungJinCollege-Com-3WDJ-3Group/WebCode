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
            ->limit(10)
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
        if($posts==null)
            return "잘못된 경로입니다.";
        else{
            $sharepostQuery=DB::table('sharepost')->select('post_id');
            $posts=$sharepostQuery
                ->addSelect('brd_id')
                ->addSelect('writer')
                ->addSelect('score_id')
                ->addSelect('price')
                ->addSelect('category')
                ->addSelect('count')
                ->addSelect('like')
                ->addSelect('title')
                ->addSelect('body')
                ->addSelect('created_at')
                ->where('post_id','=',$post_id)
                ->get();

            return json_encode($posts);
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
