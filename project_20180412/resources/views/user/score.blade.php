@extends('layouts.master')
@section('content')
<div>
    <!--보유 악보-->
    <div>제작한 악보</div>
        <div id="myScoreList">
           
                @foreach($retain as $arr)
                <div>
                    <dl>
                        <dt>
                            「{{$arr->title}}」
                        </dt>
                        <dd>
                            <a href="{{route('main.edit',$arr->score_id)}}" class="btn btn-primary">
                                <img class="tempImage" name="scoreImage" value={{$arr->num}}></img>
                            </a>
                        </dd>
                    </dl>
                </div>
                @endforeach
        </div>    
    </div>
    <!--구입악보-->
    <!--보유 악보-->
    <div>구입한 악보</div>
        <div id="myScoreList">
                @foreach($purchase as $arr)
                <div>
                    <dl>
                        <dt>
                            「{{$arr->title}}」
                        </dt>
                        <dd>
                            <a href="{{route('main.edit',$arr->score_id)}}" class="btn btn-primary">
                                <img class="tempImage" name="scoreImage" value={{$arr->num}}></img>
                            </a>
                        </dd>
                    </dl>
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