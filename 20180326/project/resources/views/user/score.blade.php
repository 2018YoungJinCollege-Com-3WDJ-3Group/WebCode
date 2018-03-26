@extends('layouts.master')
@section('content')
    <!--악보 판매게시판-->
    <div>내 악보</div>
    
        
    
        <div id="myScoreList">
            
                @foreach($array as $arr)
                <div>
                    <div>악보 제목</div>
                    <div>
                        <a href="{{route('main.edit',$arr->num)}}" class="btn btn-primary">
                            <img class="tempImage" name="scoreImage" value={{$arr->num}}></img>
                        </a>
                        
                        
                    </div>
                </div>
                @endforeach
                
        </div>    
    </div>
   
    
    
    
    
    <!--
    흐름도
    악보 클릭 시 악보 고유 번호를 넘겨서
    create의 openScore(scoreID)를 작동
    거기서 readScoreToDB(scoreID)를 작동 시켜서 DB의 scorestring을 받아온다.
    
    <script type="text/javascript">
        $('.tempImage').click(function (){
            event.preventDefault();
            
            $('#myScoreForm').submit();
            // location.href="#"
        })
    </script>
    -->
@endsection