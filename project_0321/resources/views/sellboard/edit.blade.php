@extends('layouts.master')
@section('content')
    <h1>글 수정하기</h1>
    <div>
        <form method="post" action="{{route('sellboard.update',$post->id)}}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="_method" value="put">
            <div>
                <label name="title" for="title">제목</label>
                <input type="text" name="title" class="form-control" value="{{$post->title}}"/>
            </div>
            <div>
                <label name="price" for="price">가격</label>
                 <input type="price" name="price" class="form-control" value="{{$post->price}}"/>
            </div>
            <div>
                <label name="body" for="body">내용</label>
                <textarea name="body" class="form-control">{{$post->body}}</textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="수정하기" class="btn btn-primary">
            </div>
        </form>
    </div>
@stop