<?php

namespace App\Http\Controllers;

use DB; 
use Illuminate\Http\Request;
use App\Sellboard;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class MoblieSellBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //모바일 지원
    public function index($pageid=0){
        $pageid=Input::get('pageid');
        $count=Sellboard::count();
        $query=DB::table('sellboard')->select('num');
        $posts=$query   ->addSelect('seller')
                            ->addSelect('price')
                            ->addSelect('category')
                            ->addSelect('count')
                            ->addSelect('title')
                            ->addSelect('created_at')
                            ->where('num','>',(Int)$pageid-1)
                            ->limit(2)
                            ->get();
        //$posts=DB::table('sellboard')->select('id seller price category title created_at')->get();
        //$posts=Sellboard::orderby('created_at','desc')->paginate('5');
        //DB::select(DB::raw(“SELECT * FROM `users` WHERE name = ‘$name’ ”));
        
        
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
        return view('sellboard.create');
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
        $validator=Validator::make($data=Input::all(),Sellboard::$rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        
        $post=new Sellboard();
        $post->seller='root';
        $select_val=$request->get('category');
        switch ($select_val) {

            case "1":
                // code...
                $post->category="클래식";
                break;
            case "2":
                // code...
                $post->category="뉴에이지";
                break;
            case "3":
                // code...
                $post->category="팝/가요";
                break;
            case "4":
                // code...
                $post->category="CCM";
                break;
            case "5":
                // code...
                $post->category="게임/애니";
                break;
            case "6":
                // code...
                $post->category="편곡";
                break;
            case "7":
                // code...
                $post->category="자작";
                break;
            
            default:
                // code...
                $post->category="기타";
                break;
        }
        $post->title=Input::get('title');
        $post->price=(Int)Input::get('price');
        $post->body=Input::get('body');
        if(Input::hasFile('score'))
        {
            $score=Input::file('score');
            $newFileName=time().'_'.$score->getClientOriginalName();
            $score->move(storage_path().'/file/',$newFileName);
            $post->score=$newFileName;
        }
        else
        {
            $post->scorenum='0';
        }
        $post->save();
        
        return redirect()->route('sellboard.index');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($id)
    {
        //
        $post=sellboard::find($id);
        if($post==null)
        return "잘못된 경로입니다.";
        return json_encode($post);
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
        $post=Sellboard::findOrFail($id);
        return view('sellboard.edit',compact('post'));
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
        $post=Sellboard::findOrFail($id);
        //바꾸어 줄 데이터 받아서 DB에 update
        $post->title=Input::get('title');
        $post->price=(Int)Input::get('price');
        $post->body=Input::get('body');
        
        //DB저장
        $post->save();
        return redirect()->route('sellboard.index');
        
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
        Sellboard::destroy($id);
        return $this->index();
        
    }
    public function search(Request $request){
        $temp=$request->get('search_tag');
       
        return $request->all();
    }
}
