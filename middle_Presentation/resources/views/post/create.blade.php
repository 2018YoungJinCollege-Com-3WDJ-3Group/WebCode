@extends('layouts.master')
@section('content')
<h1>글작성하기</h1>
<div>
    <form method="post" action="{{route('Post.store')}}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div>
        <label name="title" for="title">제목</label>
        <input type="text" name="title" class="form-control" placeholder="제목 입력" value="{{ old('title') }}"/>
    </div>
    <div class="form-group">
        <label name="file" for="file">파일</label>
        <input type="file" name="score" value=""/>
    </div>
    
    <div>
        <label name="tag" for="title">태그</label>
        <input type="text" name="category" class="form-control"  placeholder="태그 입력" value="{{ old('category') }}"/>
    </div>
    <div>
        <label name="body" for="body">내용</label>
        <textarea name="body" class="form-control" placeholder="내용 입력">{{ old('body') }}</textarea>
    </div>
    <div class="form-group">
        <input type="submit" value="생성하기" class="btn btn-primary">
    </div>
    </form>
    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign"></span>
            <span class="sr-only">Error:</span>
            @foreach($errors->all() as $message)
                {{$message}}
            @endforeach
        </div>
    @endif
</div>
@stop