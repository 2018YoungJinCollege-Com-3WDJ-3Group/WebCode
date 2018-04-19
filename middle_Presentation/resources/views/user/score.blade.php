@extends('layouts.master')
@section('content')

    <!--보유 악보-->
    <div align="center">
        <div ><h1 style="font-weight:bold; color: rgb(40,40,40);">내 악보</h1></div>
    
            <div class="postStyle" style="text-align:center;width:100%">
                <div class="showgrid">
                    @foreach($retain as $arr)
                        <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                         	<div class="flipper">
                    		<div class="front" style="background : url('/img/treeman.jpg') 0 0 no-repeat; background-size : 400px 400px;">
                    		      <h1>{{$arr->title}}</h1>
                    		      
                    		</div> <!--썸네일 드갈거-->
                    		<div class="back" style="background : rgba(120,120,120,0.5)"><!--게시글 정보 드갈거-->
                    		    <a href="{{route('main.edit',$arr->score_id)}}"><input class="btn btn-primary" type="button" value="수정하기"></a>
                    		    <input class="btn btn-primary" type="button" value="미리듣기">
                    		        
                    		    </div>
                    	    </div>
                        </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--구입악보-->
    <!--보유 악보-->
    <div align="center">
    <div><h1 style="font-weight:bold; color: rgb(40,40,40);">구매악보</h1></div>
        <div class="postStyle" style="text-align:center;width:100%">
            <div class="showgrid">
                @foreach($purchase as $arr)
                    <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                         	<div class="flipper">
                    		<div class="front" style="background : url('/img/treeman.jpg') 0 0 no-repeat; background-size:400px 400px;">
                    		    <h1>{{$arr->title}}</h1>
                    		</div> <!--썸네일 드갈거-->
                    		<div class="back" style="background : rgba(120,120,120,0.5)"><!--게시글 정보 드갈거-->
                    		    <a href="{{route('main.edit',$arr->score_id)}}"><input class="btn btn-primary" type="button" value="수정하기"></a>
                    		    <input class="btn btn-primary" type="button" value="미리듣기">
                       		</div>
                    	</div>
                    </div>
                @endforeach
            </div>
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