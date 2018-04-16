@extends('layouts.master')
@section('content')



<h1>공유하기</h1>
<div>
    <form method="post" action="{{route('Share.store')}}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div>
        <label name="title" for="title">제목</label>
        <input type="text" name="title" class="form-control" value="{{ old('title') }}"/>
    </div>
    
    <!-- modal Test 
         By  Jquery    
                    --->
    
    
    
    
    
    
    
    <div>
        <label name="score_id" for="score_id">악보 넘버</label>
        
        <input type="text" name="score_id" class="form-control"   value="{{isset($score->score_id)?$score->score_id:old('score_id') }}" readonly/>
    </div>
    
    <div>
        <label name="title" for="title">필요 포인트</label>
        <input type="text" name="price" class="form-control" value="{{ old('price') }}"/>
    </div>
    <div>
        <label name="title" for="title">카테고리</label>
        <select name="category">
            <option value="{{isset($score->category)?$score->category:old('category') }}">
                {{isset($score->category)?$score->category:old('category') }}
                </option>
        </select>
    </div>
    <div>
        <label name="body" for="body">내용</label>
        <textarea name="body" class="form-control" >{{ old('body') }}</textarea>
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