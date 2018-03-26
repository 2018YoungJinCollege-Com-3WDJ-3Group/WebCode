@extends('layouts.master')
@section('content')
<h1>판매하기</h1>
<div>
    <form method="post" action="{{route('sellboard.store')}}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div>
        <label name="title" for="title">제목</label>
        <input type="text" name="title" class="form-control" value="{{ old('title') }}"/>
    </div>
    <div class="form-group">
        <label name="file" for="file">파일</label>
        <input type="file" name="score" value=""/>
    </div>
    <div>
        <label name="title" for="title">가격</label>
        <input type="text" name="price" class="form-control"  placeholder="0" value="{{ old('price') }}"/>
    </div>
    <div>
        <label name="title" for="title">카테고리</label>
        <select name="category">
                        <option value="1">클래식</option>
                        <option value="2">뉴에이지</option>
                        <option value="3">팝/가요</option>
                        <option value="4">CCM</option>
                        <option value="5">게임/애니</option>
                        <option value="6">편곡</option>
                        <option value="7">자작</option>
                        <option value="8">기타</option>
                        
        </select>
    </div>
    <div>
        <label name="body" for="body">내용</label>
        <textarea name="body" class="form-control"  value="{{ old('body') }}"></textarea>
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