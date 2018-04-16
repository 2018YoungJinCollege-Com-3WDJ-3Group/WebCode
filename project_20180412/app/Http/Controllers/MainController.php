<?php

namespace App\Http\Controllers;
use DB; 
use App\Score;
use App\Retain;
use App\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $category=DB::table('boardcategory')->where('brd_id','=',1)->get();
        return view('main.create',compact('post','category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   $current_user=session()->get('user_name');
        $score_writer;
        if(session()->has('writer')){
           
            $score_writer=session()->pull('writer');
            
        }
        else{
              $score_writer=session()->get('user_name');
        }
        //악보 정보 table에 저장.
        $is_loign=session()->get('is_login');
        if($is_loign)
        {
            $post=new Score();
            //현재 사용자와 제작자가 동일하다면...
            if($current_user==$score_writer){
                $post->writer=$score_writer;
                $post_string=$request->get('tempo').";".$request->get('score');
                $post->scorestring=$post_string;
                $post->title=$request->get('title');
                $post->category=$request->get('category');
                $post->comment=$request->get('comment');
                $post->thumnail='nothing';
                }
        
            else{
            
                $post->writer=$current_user;
                $post_string=$request->get('tempo').";".$request->get('score');
                $post->scorestring=$post_string;
                $post->title=$request->get('title');
                $post->category=$request->get('category');
                $post->comment=$request->get('comment');
                $post->thumnail='nothing';
                $post->confirmed=0;
                }
                $post->save();
        //악보 정보 table의 악보 순번&회원 테이블에서 받은 등록 순번(id)를 
        //FK로 입력받는 retain테이블에 저장
        $score=DB::table('score')
                    ->orderByRaw('created_at DESC')
                    ->first();
        $retain=new Retain();
        $retain->user_id=session()->get('user_id');
        $retain->score_id=$score->score_id;
        $retain->save();
        
        //확인 창 
        $response = array(
            'status'    => 'success',
            'msg'       => '새로 저장되었습니다.',
            'scorenum'       => $score->score_id,
            
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
        //$id는 악보번호를 나타낸다.... 그러므로 구매악보를 통한 수정을 원하면 현재 내가 악보를 가지고 있는지 확인
        $user_id=session()->get('user_id');
        //구매 악보가 있다면....
        $bool = DB::table('purchase')
                    ->where('user_id', $user_id)
                    ->Where('score_id', $id)
                    ->exists();
        try{
        $post=Score::findOrFail($id);
        
        if(session()->get('user_name')!==null){
            $user=session()->get('user_name');
        }
        else{
            $user="";
        }
        if($post->writer==$user||$bool){
            session()->put('writer',$post->writer);
            $category=DB::table('boardcategory')->where('brd_id','=',1)->get();
            return view('main.create',compact('post','category'));
        }
        else
            return redirect('/');
        }catch(\Exception $e){
            return redirect('/');
        }
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
        $current_user=session()->get('user_name');
        if($post->writer==$current_user){
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
        }
        else{
        $response = array(
            'status' => 'success',
            'msg' => '작성자와 수정자가 다릅니다.',
        );
            
        }
        return \Response::json($response);   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     //악보 제거
    public function destroy($id)
    {
        //
        $score=Score::findOrFail($id);
        $writer=$score->writer;
        $user=session()->get('user_name');
        if($writer==$user){
        Score::destroy($id);
         $response = array(
            'status' => 'success',
            'msg' => '삭제되었습니다.',
        );
        
        }
        else{
        $response = array(
            'status' => 'success',
            'msg' => '작성자가 아닙니다..',
        );
            
        }
        return \Response::json($response);   
    }
    //파일 업로드
    public function transfer(Request $request){
    $file=$request->file('file');
    $path=$file->storeAs('upload',$file->getClientOriginalName());
    
    //파일 업로드
    //$file->move(public_path('upload'),$file->getClientOriginalName());
    //$_SESSION['file_path']=public_path('upload')."/".$file->getClientOriginalName();
    // $file_path=public_path('upload')."/".$file->getClientOriginalName();
    $response = array(
            'status' => 'success',
            'msg' => '성공적으로 xml저장되었습니다.',
            'file_path'=>url('storage/'.$path)
        );
         return \Response::json($response);   
    }
  
    public function getxml(Request $request){
        $XML=$request->get('XML_String');
        $post=array('scorestring'=>$XML);
        
        
        $category=DB::table('boardcategory')->where('brd_id','=',1)->get();
        return view('main.create',compact('post','category'));
    } 

}
