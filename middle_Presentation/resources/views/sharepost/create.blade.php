@extends('layouts.master')
@section('content')


<div style="margin:auto; width:70%;">
    <h1>공유하기</h1>
    <div>
        <form method="post" action="{{route('Share.store')}}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div>
            <label name="title" for="title" style="float:left; font-size:18px">제목</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}"/>
            <br>
        </div>
        
        <div>
            <input type="hidden" name="score_id" class="form-control"   value="{{isset($score->score_id)?$score->score_id:old('score_id') }}" readonly/>
        </div>
        
        <div>
            <label name="title" for="title" style="font-size:18px;">카테고리</label>
            <select name="category">
                <option value="{{isset($score->category)?$score->category:old('category') }}">
                    {{isset($score->category)?$score->category:old('category') }}
                </option>
            </select>
            <label name="title" for="title" style="font-size:18px; float:left; display:inline" >필요 포인트</label>
            <input type="text" name="price" class="form-control" value="{{ old('price') }}"/>
        
        </div>
        <div>
            <label name="body" for="body" style="font-size:18px; float:left;">내용</label>
            <textarea name="body" class="form-control" rows="10">{{ old('body') }}</textarea>
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
                    {{$message}}l;
                @endforeach
            </div>
        @endif
    </div>
</div>



@stop