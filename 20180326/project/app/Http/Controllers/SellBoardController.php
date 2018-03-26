<?php

namespace App\Http\Controllers;
use DB; 
use Illuminate\Http\Request;
use App\Sellboard;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class SellBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //전체 출력
        //$posts=Sellboard::all();
        //페이지 네이션
        $posts=Sellboard::orderby('created_at','desc')->paginate('5');
        return view('sellboard.index',compact('posts'));
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
        $post->seller=session()->get('user_name');
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
        return view('sellboard.index');
        else
        return view('sellboard.show',compact('post'));
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
        return redirect()->route('sellboard.index');
        
    }
    public function search(Request $request){
        $temp=$request->get('search_tag');
       
        return $request->all();
    }
    
    
   
    
    
}
