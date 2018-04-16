@extends('layouts.master')
@section('content')
    <h1>글 수정하기</h1>
    <div>
        <form method="post" action="{{route('Share.update',$post->post_id)}}" enctype="multipart/form-data">
            <!--<input type="hidden" name="_token" value="{{csrf_token()}}">-->
            <input type="hidden" name="_method" value="put">
            <div>
                <label name="title" for="title">제목</label>
                @if(old('title')==null)
                <input type="text" name="title" class="form-control" value="{{$post->title}}"/>
                @else
                <input type="text" name="title" class="form-control" value="{{old('title')}}"/>
                @endif
            </div>
            <article>
                <span>악보 넘버: {{$post->score_id}}</span>
            </article>
            <div>
                <label name="price" for="price">가격</label>
                @if(old('price')==null)
                <input type="text" name="price" class="form-control" value="{{$post->price}}"/>
                @else
                <input type="text" name="price" class="form-control" value="{{old('price')}}"/>
                @endif
            </div>
            <div>
                <label name="body" for="body">내용</label>
                @if(old('body')==null)
                <textarea name="body" class="form-control">{{$post->body}}</textarea>
                @else
                <textarea name="body" class="form-control">{{old('body')}}</textarea>
                @endif
            </div>
            <div class="form-group">
                <input type="submit" value="수정하기" class="btn btn-primary">
            </div>
        </form>
    </div>
    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign"></span>
            <span class="sr-only">Error:</span>
            @foreach($errors->all() as $message)
                {{$message}}
            @endforeach
        </div>
    @endif
@stop