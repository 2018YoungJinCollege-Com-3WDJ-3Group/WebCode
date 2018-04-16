@extends('layouts.master')
@section('content')
    <!--자유 게시판-->
    <div class="baseBoard">
        <table style="text-align: center" >
            <tr>
                <td colspan="12" style="text-align: center">커뮤니티 게시판</td>
            </tr>
          
            <tr>
                <td colspan="3">제목</td>
                <td colspan="3">작성자</td>
                <td colspan="3">카테고리</td>
                <td colspan="3">좋아요</td>
                <!--게시판 내용 출력.-->
            </tr>
           
            @foreach($posts as $data)
            <tr>         
                    <td colspan="3"><a href=#>[{{$data->category}}]</a><a href={{route("Post.show",$data->post_id)}}>{{$data->title}}</a></td>
                    <td colspan="3">{{$data->writer}}</td>
                    <td colspan="3">{{$data->category}}</td>
                    <td colspan="3">{{$data->like}}</td>
            </tr>
            @endforeach
            
        </table>
        @if(session()->get('is_login'))
        <a href="{{route('Post.create')}}" class="btn btn-primary">글 작성하기</a>
        @else
        
        @endif
        
    </div>
{!!$posts->render()!!}
@endsection