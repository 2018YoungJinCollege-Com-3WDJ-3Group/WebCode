@extends('layouts.master')
@section('content')
    
    <!--악보 테이블-->
    <div>
    <table class="table table-piano table-bordered table-hover table-condensed" id="pianoTable" style="user-select: none;">
        <!--멜로디 순서-->
        <thead id="theadOfPianoTable" >
        </thead>
        <!--//악보-->
        <tbody id="tbodyOfPianoTable">
        <?php
        include_once '../app/keyboard.php';
        $temp = new keyboard();
        $temp->createTable();
        ?>
        </tbody>
    </table>
    </div>
    <!--기능-->
    <div id="div_musicController">
    <button class="btn btn-default" id="button_play">미리듣기</button>
    <button class="btn btn-default" id="button_convert">악보 복사</button>
    <button class="btn btn-default" id="button_clear">클리어</button>
    <button class="btn btn-default" id="button_read">불러오기</button>
    <button class="btn btn-default" id="button_save">저장하기</button>
    템포<input  type="text" id="input_tempo" placeholder="Tempo">
    시작 위치<input  type="text" id="input_startPoint" placeholder="Record Number">
    종료 위치<input  type="text" id="input_endPoint" placeholder="Record Number">    
    </div>
    <script src="{{asset('js/jquery-3.3.1.js')}}"></script>
    
<script>
    var audioHandler;
    const MAX_NOTES = 30;


    // createPiano(13);

    //초기 동작
    {tableCreate(32);}

    function tableCreate(max) {


        for(var i = 0; i < max; i++){
            createHead();

            for(var j = 0; j < MAX_NOTES; j++) {
                createScore(j);
            }
        }




    }//function-end
    
    //상단 세로줄 넘버링 제작
    function createHead() {
        var thead = document.getElementById('theadOfPianoTable');


        if(thead.childElementCount === 0) {
            var list = document.createElement('th');
            list.innerText = "항목";
            thead.appendChild(list);
        }
        var createdTH = document.createElement('th');
        createdTH.innerText = thead.childElementCount;
        thead.appendChild(createdTH);
    }

    //악보 입력 부분 제작
    function createScore(i) {

        var tbody = document.getElementById('tbodyOfPianoTable');
        var createdTD = document.createElement('td');
        var createdIMG = document.createElement('img');


        createdTD.setAttribute('name',tbody.children[i].firstChild.id);
        createdTD.classList.add('cell-piano');
        
        createdIMG.classList.add('image-unput');
        // createdIMG.width    ="10dp";
        // createdIMG.height   ="10dp";
        

        if(tbody.children[i].childElementCount%8 == 0)
            createdTD.innerHTML = tbody.children[i].firstChild.innerHTML;
        else
            createdTD.innerHTML = "　";
        
        createdTD.appendChild(createdIMG);
        
        tbody.children[i].appendChild(createdTD);
        
    }


    //악보 클릭 시 음원 재생
    $('#tbodyOfPianoTable').on('click','.cell-piano',function () {

        if($(this).is(".cell-piano-input") === true){
            this.classList.remove("cell-piano-input");
            this.classList.remove("success");
        }
        else{
            var audio = document.createElement('audio');
            audio.setAttribute('src',"{{asset('wav/note')}}/note\_"+this.getAttribute('name')+".wav");
            audio.play();

            this.classList.add("cell-piano-input");
            this.classList.add("success");
        }

        var maxRecord = event.target.parentElement.parentElement.parentElement.firstElementChild.childElementCount;

        if(event.target.cellIndex >= maxRecord-3){
            tableCreate(8);
            screenChaser($('#theadOfPianoTable')[0].childElementCount);
        }
    });

    


    //미리듣기 클릭 이벤트
    $('#button_play').click(
        function () {
            window.clearInterval(audioHandler);


            var currentLine = $('#input_startPoint')[0].value;
            var endLine = $('#input_endPoint')[0].value;

            if(!currentLine)
                currentLine = 1;

            if(!endLine)
                endLine = document.getElementById('theadOfPianoTable').children.length - 1;

            var tempo = getTempo();

            audioHandler = setInterval(function () {
                try {
                    removeFocus('line-focus');
                } catch(e){

                }

                if(currentLine > 0)
                    focusLine(currentLine);


            var screenLine = parseInt(window.screen.width/33);


                if(currentLine%screenLine == 0)
                    screenChaser(screenLine);
                try {
                    audioPlay(currentLine);
                } catch (e){
                    console.log("음원 실행 오류");
                }


                if(currentLine == endLine){
                    window.clearInterval(audioHandler);
                    
                    var endTimer = setTimeout(function(){
                        removeFocus('line-focus');
                        audioHandler = undefined;
                        
                    },1000);
                }

                currentLine++;
            },tempo);


        }
    );

    //악보→오르골 전용 스트링 변환 이벤트
    $('#button_convert').click(
        function () {
            convertString(1);
        }
    );

    //악보 초기화
    $('#button_clear').click(
        
        function() {
            clearScore();
        }    
            
        
    );

    //오르골 전용 스트링→악보 변환 이벤트
    $('#button_read').click(
        function () {
            openScore();
        }
    );

    // $('.cell-piano').hover(function (){
    //     crossFocus(event);
    // },function (){
    //     removeFocus('crossFocus')
    // });
    
    
    
    $('#tbodyOfPianoTable').on("mouseenter",".cell-piano", function() {
        if(audioHandler == undefined)
        crossFocus(event);
    }).on('mouseleave','.cell-piano', function() {
        
        removeFocus('crossFocus')
    });
    

    function audioPlay(currentLine) {
        var playlist = new Array();

        playlist[0] = getPlaylist(currentLine);



        for(var i = 0; i < playlist.length; i++) {
            var src = "";
            var audio = "";
            if(playlist[i].length > 0) {
                for(var j = 0; j < playlist[i].length; j++) {
                    src = "{{asset('wav/note')}}/note_" + (playlist[i][j]) + ".wav";
                    audio = new Audio(src);
                    audio.play();
                }
            }
            else
                continue;



        }


    }

    //상단 클릭 시 시작점 변경
    $('#theadOfPianoTable').on('click','th',function () {
        var clickPoint = event.target.innerHTML;
        if(clickPoint != "항목"){
            $('#input_startPoint')[0].value = clickPoint;
        }
    });
    
    //상단 더블 클릭 시 종료점 변경(시작점 변경과 연동되어 있음)
    $('#theadOfPianoTable').on('dblclick','th',function () {
        var clickPoint = event.target.innerHTML;
        if(clickPoint != "항목"){
            $('#input_endPoint')[0].value = clickPoint;
        }
    });
    
    
    $('#button_save').click(function() {
        sendScore();
    })
    

    //세로 줄에서 연주해야되는 음원 리스트 획득
    function getPlaylist(line) {
        var table = document.getElementById('tbodyOfPianoTable');
        var lineArray = new Array();
        for(var i = 0; i < table.children.length;i++){
            var selected = table.children[i].children[line];
            if($(selected).is(".cell-piano-input") === true)
                lineArray.push(table.children[i].children[line].getAttribute('name'));
        }
 
        return lineArray;
    }
    
    //악보→오르골 전용 스트링
    function convertString(copyStatus) {
        var maxOfLine = document.getElementById('theadOfPianoTable').children.length - 1;
        var melodyArray = new Array();
        var melodyString = "";
        var currentPlayList = "";
        for(var i = 0; i < maxOfLine; i++) {
            currentPlayList = getPlaylist(i + 1);
            if(currentPlayList != ""){
                for(var j = 0; j < currentPlayList.length; j++) {
                    currentPlayList[j] = String.fromCharCode(parseInt(currentPlayList[j])+25);
                }
                melodyArray.push(currentPlayList);
            }
            else
                melodyArray.push(0);

                melodyArray.push("r");
        }

        var tempo = $('#input_tempo')[0].value;

        if(tempo == ""){
            tempo = 80;
        }

        melodyString += tempo+";";

        for(var i = 0; i < melodyArray.length; i++){
                for(var j = 0; j < melodyArray[i].length; j++){
                    melodyString += melodyArray[i][j];
                }

            }

        while(melodyString.search(/rr$/) > -1) {
            melodyString = melodyString.replace(/rr$/,"r");
        }

        
        if(copyStatus){
        var temp = document.createElement('input');
        temp.type = 'text';
        
        
        $('body').append(temp);
        temp.value = melodyString;
        temp.select();
        document.execCommand('copy');
        temp.remove (this);
        }
        
        
        return melodyString;
    }

    
      
    


    //Tempo로 칭해지는 딜레이를 구하는 계산식
    function getTempo() {
        var inputTempo =    $('#input_tempo')[0].value;

        if(inputTempo == "")
            inputTempo = 80;

            inputTempo = 600 / inputTempo * 100 ;
            // 60 == 1000
            //

        return inputTempo;

    }

    //악보 초기화
    function clearScore() {
        
            
        window.clearInterval(audioHandler);
        
        $('#theadOfPianoTable>th').remove();
        $('.cell-piano').remove();
        tableCreate(32);
    }

    //오르골 전용 스트링→악보
    function openScore(){



        var scoreString = prompt("악보 코드 입력");

        if(scoreString === "" || scoreString === null)
            return 0;

        clearScore();

        var tempo = scoreString.split(";")[0];
        var score = scoreString.split(";")[1].split("r");
        var convertScore = [];

        tableCreate(score.length + score.length%4 - 24);


        console.log(score);

        for(var i = 0; i < score.length; i++) {
            if (!convertScore[i])
                convertScore[i] = [];


            for (var j = 0; j < score[i].length; j++) {

                var convertString = score[i][j].charCodeAt().valueOf();


                convertScore[i][j] = convertString;
            }
        }

        // tempo = getTempo(tempo);

        console.log(tempo);
        console.log(convertScore);

        $('#input_tempo')[0].value = tempo;

        for(var i = 0; i < convertScore.length; i++)
            for(var j = 0, k = 0; j < MAX_NOTES; j++){
                var currentScore = document.getElementById('tbodyOfPianoTable').children[j].children[i+1];
                if(currentScore.getAttribute('name') == convertScore[i][k] - 25) {
                    currentScore.classList.add("cell-piano-input");
                    currentScore.classList.add("success");
                    k++;
                }



            }



    }

    //css를 이용한 미리듣기 현재 진행 척도 강조
    function focusLine(currentLine) {
        var head = $('#pianoTable')[0].children[0].children[currentLine];
        var body;

        head.classList.add('line-focus');

        for(var i = 0; i < MAX_NOTES; i++){
            body = $('#pianoTable')[0].children[1].children[i].children[currentLine];
            body.classList.add('line-focus');
        }

    }
    
    //css를 이용한 현재 진행 척도 강조 해제
    function removeFocus(focusName){
        var focusedLine = document.getElementsByClassName(focusName);

        while(focusedLine.length > 0){
            focusedLine[0].classList.remove(focusName)
        }
    }

    function screenChaser(line) {
        var cellWidth = document.getElementsByName('80')[0].offsetWidth;
        // window.scrollBy(cellWidth*currentLine,0);
        window.scrollBy(cellWidth*line,0);
    }

    function crossFocus(event){
        
        var target = event.target;
        
        var horizonElements = target.parentElement;
        var currentLine = target.cellIndex;
        var currentRow = target.parentElement.rowIndex;
        var endLine = document.getElementById('theadOfPianoTable').children.length;
        
        try{
        for(var i = -1; i < 8; i++){
            var focusLine = parseInt(currentLine/8)*8+1+i;
            horizonElements.children[focusLine].classList.toggle('crossFocus');
            // var tempTarget = target.parentElement.parentElement.children[j];
            // tempTarget.children[currentLine].classList.add('crossFocus');
            
        }
        
        
        }catch(e){
            
            
        }
    }


    
    function sendScore(){
        var scoreString = convertString(0);
        var tempo = scoreString.split(";")[0];
        var score = scoreString.split(";")[1];
        var token = "{{ csrf_token() }}";
        $.ajax({
            type: "POST",
            url: "{{route('main.store')}}",
            data: {tempo: tempo, score: score,_token:token},
            //성공시 알림이 떠야하는데 jquery를 모르겠다...
            success: function( msg ) {
                alert("성공했습니다.");
                //$("#ajaxResponse").append("<div>"+msg+"</div>");
            }
        });
        
        
       /* var csrf = document.getElementById("_token").value;
        setRequestHeader("XSRF-TOKEN", csrf);
        var httpRequest;
        var url = "{{route('main.store')}}?tempo="+tempo+"&score="+score;

        
        if(window.XMLHttpRequest){
             httpRequest = new XMLHttpRequest();
        }
        else if(window.ActiveXObject){
            httpRequest = new ActiveXObject();
        }


        httpRequest.onreadystatechange = function () {
            if(httpRequest.readyState == 4 && httpRequest.status == 200){
                httpRequest.responseText;
            }
            else{
                
            }
            
        }

        httpRequest.open("post",url,true);
        httpRequest.send();
        
        */
    
    
    
    }
    
    
    
    
    
</script>

@stop

