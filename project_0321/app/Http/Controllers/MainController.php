<?php

namespace App\Http\Controllers;
use App\Score;
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
        return view('main.create');
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
        $post=new Score();
        $post->writer='root';
        $post->title='root';
        //악보가 필요해
        $post_string=$request->get('tempo').";".$request->get('score');
        $post->scorestring=$post_string;
        $post->thumnail='root';
        $post->save();
        $response = array(
            'status' => 'success',
            'msg' => 'Setting created successfully',
        );
        return \Response::json($response);
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
    public function transfer(Request $request){
    $file=$request->file('file');
    $file->move(public_path('upload'),$file->getClientOriginalName());
    $_SESSION['file_path']=public_path('upload')."/".$file->getClientOriginalName();
    return $_SESSION['file_path'];
    }
  


}
