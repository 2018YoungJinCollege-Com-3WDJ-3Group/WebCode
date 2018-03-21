@extends('layouts.master')
@section('content')
    <!--악보 판매게시판-->
    <div>
        <table style="text-align: center" >
            <tr>
                <td colspan="12" style="text-align: center">게시판</td>
            </tr>
            <tr>
                <td colspan="4">
                    <select>
                        <option value="">등록순</option>
                        <option value="">조회순</option>
                        <option value="">가격순</option>
                    </select>
                </td>
                <td colspan="4">
                    <select>
                        <option value="0">전체</option>
                        <option value="1">클래식</option>
                        <option value="2">뉴에이지</option>
                        <option value="3">팝/가요</option>
                        <option value="4">CCM</option>
                        <option value="5">게임/애니</option>
                        <option value="6">편곡</option>
                        <option value="7">자작</option>
                        <option value="8">기타</option>
                        
                    </select>
                </td>
                <td colspan="4">
                    <select >
                        <option value="1">유료</option>
                        <option value="0">무료</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="3">제목</td>
                <td colspan="3">작성자</td>
                <td colspan="3">가격</td>
                <td colspan="3">좋아요</td>
                <!--게시판 내용 출력.-->
            </tr>
           
            @foreach($posts as $data)
            <tr>         
                    <td colspan="3"><a href=#>[{{$data->category}}]</a><a href={{route("sellboard.show",$data->id)}}>{{$data->title}}</a></td>
                    <td colspan="3">{{$data->seller}}</td>
                    <td colspan="3">{{$data->price}}</td>
                    <td colspan="3">{{$data->like}}</td>
            </tr>
            @endforeach
            
        </table>
        <a href="{{route('sellboard.create')}}" class="btn btn-primary">판매하기</a>
    </div>
{!!$posts->render()!!}
@endsection