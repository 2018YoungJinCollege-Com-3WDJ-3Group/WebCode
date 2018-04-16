@extends('layouts.master')
@section('content')
    <div class="baseBoard">
    <div>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div>
        <article>
            <h1>{{$post->title}}</h1>
        </article>
        </div>
        <div id="tempDiv">
        <article >
        <button class="btn btn-primary btn-music btn-play" id="{{$post->score_id}}">▶</button>
        </article>
        </div>
        <span>가격: {{$post->price}}point</span>
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
    @if(session()->get('user_name')!=null)
        @if(session()->get('user_name')==$post->writer)
       <a href="{{route('Share.edit',$post->post_id)}}" class="btn btn-primary">수정하기</a>
        <form method="post" action="{{route('Share.destroy',$post->post_id)}}">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="submit" class="btn btn-primary" value="삭제">
        </form>
        @else
        <form method="post" action="{{route('Share.buy')}}">
            <input type="hidden" name="score_id" value="{{$post->score_id}}">
             <input type="hidden" name="post_id" value="{{$post->post_id}}">
             <input type="hidden" name="price" value="{{$post->price}}">
            <input type="submit" class="btn btn-primary" value="구입하기">
        </form>
            <a href="" class="btn btn-primary">즐겨찾기..</a>
        @endif
    @endif
        <a href="{{route('Share.index')}}" class="btn btn-primary">목록으로</a>
        </div>

<script type="text/javascript" src="{{asset('js/audio.js?ver=5')}}"></script>
<script>
    $('#tempDiv article').on('click','.btn-play',function() {
        buttonChange(event.target.id);
        
        var currentObject = document.getElementById(this.id);
        var score_id = currentObject.id;
        var scoreString;
        // var token = "{{ csrf_token() }}";
        var token = $('meta[name="csrf-token"]').attr('content');
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
    })
    
    $('#tempDiv article').on('click','.btn-stop',function() {
        buttonChange(event.target.id);
        window.clearInterval(audioHandler);
    });
    
    
    
</script>
@stop