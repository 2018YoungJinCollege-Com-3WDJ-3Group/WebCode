@extends('layouts.master')
@section('content')
    <div>
        <div>
        <article>
            <h1>{{$post->title}}</h1>
        </article>
        </div>
        <div>
        <article>
        <span>値段: {{$post->price}}円</span>
        </article>
        </div>
        
        <div>
        </hr>
        <article>
            {{$post->body}}
        </article>
        </div>
        <article>
            <a href="{{storage_path().'\\file\\'.$post->thumnail}}" download>{{$post->thumnail}}</a>
        </article>
    </div>
    @if(session()->get('user_name')==$post->seller)
       <a href="{{route('sellboard.edit',$post->num)}}" class="btn btn-primary">수정하기</a>
    <form method="post" action="{{route('sellboard.destroy',$post->id)}}">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="submit" class="btn btn-primary" value="삭제">
    </form>
        @else
        @endif
        <a href="{{route('sellboard.index')}}" class="btn btn-primary">목록으로</a>
@stop