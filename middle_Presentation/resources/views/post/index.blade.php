@extends('layouts.master')
@section('content')
    <!--자유 게시판-->
    <div class="baseBoard" style="">
        <table style="text-align:center;width:100%">
            <tr>
                <td colspan="4" style="text-align: center">커뮤니티 게시판</td>
            </tr>
          
            <tr>
                <td>제목</td>
                <td>작성자</td>
                <td>카테고리</td>
                <td>좋아요</td>
                <!--게시판 내용 출력.-->
            </tr>
           
            @foreach($posts as $data)
            <tr>         
                    <td><a href=#>[{{$data->category}}]</a><a href={{route("Post.show",$data->post_id)}}>{{$data->title}}</a></td>
                    <td>{{$data->writer}}</td>
                    <td>{{$data->category}}</td>
                    <td>{{$data->like}}</td>
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