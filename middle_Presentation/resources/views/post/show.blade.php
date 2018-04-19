@extends('layouts.master')
@section('content')
    <div class="baseBoard">
        <div>
        <article>
            <h1>{{$post->title}}</h1>
        </article>
        </div>
        <div>
        
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
    @if(session()->get('user_name')==$post->writer)
       <a href="{{route('Post.edit',$post->post_id)}}" class="btn btn-primary">수정하기</a>
    <form method="post" action="{{route('Post.destroy',$post->post_id)}}">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="submit" class="btn btn-primary" value="삭제">
    </form>
        @else
        @endif
        <a href="{{route('Post.index')}}" class="btn btn-primary">목록으로</a>
@stop