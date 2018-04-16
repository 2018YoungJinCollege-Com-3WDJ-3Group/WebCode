@extends('layouts.master')

@section('content')
<style type="text/css">
    #mask {  
        position:absolute;  
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        z-index: 9000;  
        background-color: #777777;
        display: none;  
    } 
          
    .window {
        overflow: hidden;
        position: absolute;
        top: 30%;
        left: 40%;
        width: 480px;
        z-index: 10000;
        display:none;
    }
    
    .window-inner{
        background-color: #ffffff;
        height: 320px;
    }
</style>


    <!-- --------------------------------------------------------------
    
    -------------------- / sharepost / index.blade.php ----------------
    
    --------------------------------------------------------------- -->


    <!--악보 판매게시판-->
    <div class="shareBoard">
        
        <table id="scoreList">
            <tr>
                <td colspan="5" style="text-align: center;">게시판</td>
            </tr>
            
            <tr>
                <td colspan="5" style="text-align:right">
                    <select>
                        <option value="">등록순</option>
                        <option value="">조회순</option>
                        <option value="">가격순</option>
                    </select>
                    <select>
                        @foreach($item as $category)
                        <option value="{{$category->bca_id}}">{{$category->bca_value}}</option>
                        @endforeach
                        
                    </select>
                    <select >
                        <option value="1">유료</option>
                        <option value="0">무료</option>
                    </select>
                </td>
                <td></td>
            </tr>
            
            <tr>
                <td>제목</td>
                <td>작성자</td>
                <td>가격</td>
                <td>좋아요</td>
                <td>미리듣기</td>
                <!--악보 판매 게시판 내용 출력.-->
            </tr>
           
           
            
            @foreach($posts as $data)
            <tr>         
                    <td>
                        <a href=#>[{{$data->category}}]</a>
                        <a href={{route("Share.show",$data->post_id)}}>{{$data->title}}</a>
                    </td>
                    <td>{{$data->writer}}</td>
                    <td>{{$data->price}}</td>
                    <td>{{$data->like}}</td>
                    <td>
                        <button class="btn btn-primary btn-play" id="{{$data->score_id}}">▶</button>
                    </td>
            </tr>
            @endforeach
        
            
        <tr>
            <td colspan=5>
                <button class="openMask btn btn-primary">악보 올리기</button>
            </td>
        </tr>    
        </table>
        @if(session()->get('is_login'))
        
        <!--    건 들 지 마 세 영    --->
        
        <div id="mask"></div>
    	<div class="window">
    	    
    	    <div id="myModal" class="window-inner" style="height:320px;">
    	        how to make div have fixed height size?
    	    </div>
    	    
    	    <input type="button" href="#" class="close" value="close"></button>
    	
    	
    	
        
        <!------------------------------>
        
        
        
        @endif
        
    </div>
    <div><input type="search" id="searchBar" placeholder="search keyword" name="search"/></div>
    <div>{!!$posts->render()!!}    </div>
    </div>
<script type="text/javascript" src="{{asset('js/audio.js?ver=5')}}"></script>    
<script>
    
    var data_info = new Array();
    
    
    function getScore(){

        var retain;
        
        var token = "{{ csrf_token() }}";
        $.ajax({
            type: "GET",
            url: "{{route('ShowScore')}}",
            data: {_token:token},
            
            success: function( json ) {
                
                if(json.length == 0){
                    alert(" 데이터가 없엉");
                }
                else{
                 
                    var score_id = new Array();
                    var scorestring = new Array();
                 
                    // alert(json.msg);
                    for(i in json.retain){
                        //score의 넘버..
                        data_info[i] = json.retain[i];
                        
                    }
                    return ;
                }
                return ;
            }
        });
    };

    new getScore();

    function wrapWindowByMask(data){
       
        var data_score_info = data;
        
        var score_id ;
        var score_string ;
        var score_title ;
        
        for(i in data_score_info){

            score_id = data_score_info[i].score_id;
            score_title = data_score_info[i].title;
            score_confirmed = data_score_info[i].confirmed;
            // score_string = data_score_info[i].scorestring;
            
            // alert(score_title);
            if(score_confirmed==1){
            var $form = $('<form></form>');
            
            $form.attr('action', "../Share/create");
            $form.attr('method', 'post');
            $form.attr('id',"register_form");
            $form.appendTo('.window-inner');
            
            
            var $hidden = $('<input/>');
            $hidden.attr('type','hidden');
            $hidden.attr('value',score_id);
            $hidden.attr('name',"score_id");
            $hidden.appendTo("#register_form");
            
             var $submit = $('<input/>');
            $submit.attr('type','submit');
            $submit.attr('value',score_title);
            $submit.attr('name',"title");
            $submit.appendTo("#register_form");

            }
            
            // var button = document.createElement('button');
            // var textnode = document.createTextNode(score_id);
            // button.appendChild(textnode);
            // $('.window-inner').append(button);
            // var textnode = document.createTextNode(score_string);
            // $('.window-inner').append(textnode);
            
        }
     
        //화면의 높이와 너비를 구한다.
      	var maskHeight = $(document).height();  
      	var maskWidth = $(window).width();  
      
      	//마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
      	$('#mask').css({'width':maskWidth,'height':maskHeight});  
      
      	//애니메이션 효과 - 일단 1초동안 까맣게 됐다가 80% 불투명도로 간다.
      	// $('#mask').fadeIn(1000);      
      	$('#mask').fadeTo("slow",0.8);    
      
      		//윈도우 같은 거 띄운다.
        $('.window').show();
          
    }
      	
    $(document).ready(function(){
        //검은 막 띄우기
        $('.openMask').click(function(e){
      	    e.preventDefault();
      		wrapWindowByMask(data_info);
        });
      
        //닫기 버튼을 눌렀을 때
      	$('.window .close').click(function (e) {  
      	    //링크 기본동작은 작동하지 않도록 한다.
      		e.preventDefault();  
      		$('#mask, .window').hide();
      		location.reload();
      	});       
      
      	//검은 막을 눌렀을 때
      	$('#mask').click(function () {  
      		$(this).hide();  
      		$('.window').hide();
      		location.reload();
      	});      
    });
    
    //-----------------------------------------------
    $('#scoreList tr td').on('click','button',function() {
        buttonChange(event.target.id);
    })
    
    
    
    $('#scoreList tr td').on('click','.btn-play',function (){
        
        var currentObject = document.getElementById(this.id);
        var score_id = currentObject.id;
        var scoreString;
        var token = "{{ csrf_token() }}";
        
        $.ajax({
            type: "POST",
            url: "../Share/getscorestring",
            // url: "{{route('Share.getscorestring')}}",
            data: {score_id: score_id,_token:token},
            
            success: function( json ) {
                
                scoreString = json.scorestring; // 데이터 받아서 string 입력
                play_music(scoreString);
    
            }
      });
    });
    
    $('#scoreList tr td').on('click','.btn-stop',function() {
        stop_music();
    });
    
    
</script>
    
    
    

@endsection