<?php

namespace App\Http\Controllers;

use DB; 
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $posts=Post::orderby('created_at','desc')->paginate('5');
        return view('post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('post.create');
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
        $validator=Validator::make($request->all(),Post::$rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        
        $Post=new Post();
        $Post->brd_id=3;
        $Post->writer=session()->get('user_name');
        $Post->category=$request->get('category');
        
        $Post->title=$request->get('title');
        if($request->hasFile('score'))
        {
            /*
            $score=Input::file('score');
            $newFileName=time().'_'.$score->getClientOriginalName();
            $score->move(storage_path().'/file/',$newFileName);
            $SharePost->score_id=$newFileName;
        
            */
        }
        else
        {
            
        }
        
        $Post->body=$request->get('body');
        
        $Post->save();
        
        return redirect()->route('Post.index');
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
        $post=Post::find($id);
        if($post==null)
        return view('post.index');
        else
        return view('post.show',compact('post'));
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
        $post=Post::findOrFail($id);
        return view('post.edit',compact('post'));
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
        $validator=Validator::make($data=Input::all(),Post::$rules);

        if($validator->fails())
        {
            return redirect()->route('Post.edit',$id)->withErrors($validator->errors())->withInput();

            //return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        //
        $post=Post::findOrFail($id);
        //바꾸어 줄 데이터 받아서 DB에 update
        $post->title=$request->get('title');
        $post->category=$request->get('category');
        $post->body=$request->get('body');
        
        //DB저장
        $post->save();
        return redirect()->route('Post.index');
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
        Post::destroy($id);
        return redirect()->route('Post.index');
    }
}
