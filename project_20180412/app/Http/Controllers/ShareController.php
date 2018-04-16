<?php

namespace App\Http\Controllers;
use DB; 
use Illuminate\Http\Request;
use App\Sharepost;
use App\Purchase;
use App\User;
use App\Score;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class ShareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts=SharePost::orderby('created_at','desc')->paginate('3');
        $item=DB::table('boardcategory')->where('brd_id','=',1)->get();
        //$posts=DB::table('sharepost')->join('score','sharepost.score_id','=','score.score_id')->orderby('sharepost.created_at','desc')->paginate('2');
        
        return view('sharepost.index',compact('posts','item'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        
        $score_id=$request->get('score_id');
         $score=DB::table('score')->where('score_id','=',$score_id)->first();
        return view('sharepost.create',compact('score'));
        
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
        
        $validator=Validator::make($data=Input::all(),SharePost::$rules);

        if($validator->fails())
        {
            //URL 리다이렉트.
            return redirect('/Share/create')->withErrors($validator->errors())->withInput();
            //return redirect()->route('Share.create',['score_id'=>$request->get('score_id')])->withErrors($validator->errors())->withInput();
        }
        else{
        $SharePost=new SharePost();
        $SharePost->brd_id=1;
        $SharePost->writer=session()->get('user_name');
        $SharePost->category=$request->get('category');
        
        
        $SharePost->title=$request->get('title');
        $SharePost->score_id=(Int)$request->get('score_id');
        $SharePost->price=(Int)$request->get('price');
        $SharePost->body=$request->get('body');
        $SharePost->save();
        
        return redirect()->route('Share.index');
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
        
        $post=SharePost::find($id);
        if($post==null)
        return view('sharepost.index');
        else
        return view('sharepost.show',compact('post'));
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
        $post=SharePost::findOrFail($id);
        return view('sharepost.edit',compact('post'));
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
        $validator=Validator::make($data=Input::all(),SharePost::$rules);

        if($validator->fails())
        {
            return redirect()->route('Share.edit',$id)->withErrors($validator->errors())->withInput();

            //return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        //
        $post=SharePost::findOrFail($id);
        //바꾸어 줄 데이터 받아서 DB에 update
        $post->title=$request->get('title');
        $post->price=(Int)$request->get('price');
        $post->body=$request->get('body');
        
        //DB저장
        $post->save();
        return redirect()->route('Share.index');
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
        SharePost::destroy($id);
        return redirect()->route('Share.index');
    }
    
    public function buy(Request $request)
    {
        $post_id=$request->get('post_id');
        $score_id=$request->get('score_id');
        $point=(Int)$request->get('price');
        $user_id=session()->get('user_id');
        $user_point=session()->get('point')-$point;
        $bool=DB::table('purchase')->where(
            [
                ['user_id', $user_id],['score_id',$score_id]
            ]
            )->exists();
        if($bool==false){
           if($user_point<0){
                return redirect()->route('Share.show', ['post_id' => $post_id])->with('status', '포인트가 모자릅니다..');
            }
            else{
            $purchase=new Purchase();
            $purchase->user_id=$user_id;
            $purchase->score_id=$score_id;
            $purchase->save();
            //유저 보유 포인트 차감
            $user=User::findOrFail($user_id);
            
            $user->point= $user_point;
            $user->save();
            $request->session()->put('point', $user_point);
            return redirect()->route('Share.show', ['post_id' => $post_id])->with('status', '구매가 완료되었습니다..');
            }
        
        }
        else{
         return redirect()->route('Share.show', ['post_id' => $post_id])->with('status', '이미 구입한 악보 입니다.');
        }
    }
    public function getscorestring(Request $request)
    {
        $score_id=$request->get('score_id');
        $score=Score::findOrFail($score_id);
        $confirmed=$score->confirmed;
        $scorestring=$score->scorestring;
        if($confirmed==1){
        //확인 창 
        $response = array(
            'status'    => 'success',
            'msg'       => '확인되었습니다.',
            'scorestring'       => $scorestring,
            
        );
        }
        else{
            $response = array(
            'status'    => 'success',
            'msg'       => '공유 할 수 없는 파일입니다..',
           
            
        );
        }
        return \Response::json($response);   
    
        
    }
}
