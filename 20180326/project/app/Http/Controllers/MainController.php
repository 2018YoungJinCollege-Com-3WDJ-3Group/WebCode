<?php

namespace App\Http\Controllers;
use DB; 
use App\Score;
use App\Retain;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('main.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $post='0';
        return view('main.create',compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //악보 정보 table에 저장.
        $is_loign=session()->get('is_login');
        if($is_loign)
        {
         $post=new Score();
        $post->writer=session()->get('user_name');
        //악보가 필요해
        $post_string=$request->get('tempo').";".$request->get('score');
        $post->scorestring=$post_string;
        $post->title=$request->get('title');
        $post->category=$request->get('category');
        $post->comment=$request->get('comment');
        $post->thumnail='nothing';
        
        $post->save();
        //악보 정보 table의 악보 순번&회원 테이블에서 받은 등록 순번(id)를 
        //FK로 입력받는 retain테이블에 저장
        $score=DB::table('score')
                    ->orderByRaw('created_at DESC')
                    ->first();
        $retain=new Retain();
        $retain->user_id=session()->get('user_id');
        $retain->score_id=$score->num;
        $retain->save();
        
        //확인 창 
        $response = array(
            'status' => 'success',
            'msg' => '저장되었습니다.',
        );
        return \Response::json($response);   
        }
        else
        {
             $response = array(
            'status' => 'success',
            'msg' => '로그인이 필요합니다.',
        );
        return \Response::json($response);   
        }
        
    
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
        $post=Score::findOrFail($id);
        if(session()->get('user_name')!==null){
            $user=session()->get('user_name');
        }
        else{
            $user="";
        }
        if($post->writer==$user)
            return view('main.create',compact('post'));
        else
            return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     //악보 데이터 수정.
    public function update(Request $request, $id)
    {
        //
        
        $post=Score::findOrFail($id);
        //바꾸어 줄 데이터 받아서 DB에 update
        $post_string=$request->get('tempo').";".$request->get('score');
        $post->scorestring=$post_string;
        $post->title=$request->get('title');
        $post->category=$request->get('category');
        $post->comment=$request->get('comment');
        $post->thumnail='nothing';
        
        //DB저장
        $post->save();
         //확인 창 
        $response = array(
            'status' => 'success',
            'msg' => '수정되었습니다.',
        );
        return \Response::json($response);   
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
    public function transfer(Request $request){
    $file=$request->file('file');
    $file->move(public_path('upload'),$file->getClientOriginalName());
    $_SESSION['file_path']=public_path('upload')."/".$file->getClientOriginalName();
    return $_SESSION['file_path'];
    }
  


}
