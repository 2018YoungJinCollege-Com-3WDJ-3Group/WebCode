@extends('layouts.master')
@section('content')
    
    <script>
        function pop_up() {
            alert('팝업');
        }
    </script>
    
    
    <div>
        <!--악보 작성-->
        <a href="{{route('main.create')}}"><img src="http://via.placeholder.com/200x200"></a>
        <!--악보 수정-->
        <a href="https://placeholder.com"><img src="http://via.placeholder.com/200x200"></a>
        <!--악보 변환 클릭시 파일 선택창 팝업-->
        <a href=""><img src="http://via.placeholder.com/200x200" onclick="pop_up()">
        <div>
          <form method="post" action="{{route('upload')}}" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
  
        <div class="form-group">
        <label name="file" for="file">파일</label>
        <input type="file" name="file" value=""/>
        <input type="submit" value="눌러눌러"/>
        </div>
        </div>
        </a>
    </div>
 
    
@stop