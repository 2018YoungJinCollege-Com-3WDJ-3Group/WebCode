@extends('layouts.master')
@section('content')


    <!--악보 테이블-->
    <div class="baseBoard">
    <div id="scoreInfo">
        <div>
        <input type="text" name="scoreTitle" placeholder="제목" style="width:50%"/>
        </div>
        
        <div>
        <select name="scoreCategory">
            @foreach($category as $row)
            <option>{{$row->bca_value}}</option>
            
            @endforeach
            </select>
        </div>
        
        <div>
        <div>설명</div>
        <input type="textarea" name="scoreComment" style="width:50%"/>
        </div>
    </div>
        
        
        
        
    <div id="musicscore">
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
    </div>
    <!--기능-->
    <div id="div_musicController" style="padding-top:10px">
    <input type="text" id="input_musicLength" disabled style="text-align:center"/>
    <button class="btn btn-default btn-play" id="button_play">▶</button>
    <button class="btn btn-default" id="button_convert">악보 복사</button>
    <button class="btn btn-default" id="button_clear">클리어</button>
    <button class="btn btn-default" id="button_read">불러오기</button>
    <button class="btn btn-default" id="button_save_overwrite">수정하기</button>
    <button class="btn btn-default" id="button_save_new">신규 저장</button>
    @php
    if(preg_match("/edit/",$_SERVER["REQUEST_URI"]))
        echo "<button class=\"btn btn-default\" id=\"button_delete\">삭제하기</button>"
    @endphp
    
    
   
    템포<input  type="text" id="input_tempo" placeholder="Tempo">
    <button class="btn btn-default" id="button_open_tempo_modal" data-toggle="modal" data-target="#tempoModal">템포 모달</button>
    
    시작 위치<input  type="text" id="input_startPoint" placeholder="Record Number">
    종료 위치<input  type="text" id="input_endPoint" placeholder="Record Number">  
    
    </div>
    
    <div id="tempoModal" class="modal modal-lg fade" role="dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">템포 변조</h4>
            </div>
            <div class="modal-body">
                <div id="tempoList"></div>
                <button class="btn btn-default" id="button_tempo_change">+</button>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            
        </div>
        
    </div>
<!--<script type="text/javascript" src="{{asset('js/musicbox.js?ver=2')}}"></script>    -->
<script type="text/javascript" src="{{asset('js/audio.js?ver=5')}}"></script>
<script type="text/javascript">




  
    
var audioHandler;
var MAX_NOTES = 30;
var scorenum = "";
var tempoArray = [createTempoPoint(1,80)];

// createPiano(13);

//초기 동작
{
    if(location.href.search("edit") > -1||location.href.search("xml") > -1){
        
        openScore();
    }
    else
        tableCreate(32);
    
}

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
    // createdTD.classList.add('ripple'); 눈 아파
    
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
        
    }
    else{
        var audio = document.createElement('audio');
        audio.setAttribute('src',"{{asset('wav/note')}}/note\_"+this.getAttribute('name')+".wav");
        audio.play();

        this.classList.add("cell-piano-input");
        
    }

    var maxRecord = event.target.parentElement.parentElement.parentElement.firstElementChild.childElementCount;

    if(event.target.cellIndex >= maxRecord-3){
        tableCreate(8);
        screenChaser($('#theadOfPianoTable')[0].childElementCount);
    }
});




//미리듣기 클릭 이벤트
$('#div_musicController').on('click','.btn-play',function() {
        window.clearInterval(audioHandler);
        tempoArray[0] = createTempoPoint(1,getTempo($('#input_tempo')[0].value));

        var currentLine = $('#input_startPoint')[0].value;
        var endLine = $('#input_endPoint')[0].value;

        if(!currentLine)
            currentLine = 0;

        if(!endLine)
            endLine = document.getElementById('theadOfPianoTable').children.length - 1;

        var tempo = getTempo($('#input_tempo')[0].value);

        var stringArray = convertString().split(";")[1].split("r");
        
        audioHandler = setInterval(function () {
            try {
                removeFocus('line-focus');
            } catch(e){

            }

            // if(currentLine > 0)
                focusLine(parseInt(currentLine) + 1);


        var screenLine = parseInt(window.screen.width/33);


            if(currentLine%screenLine == 0 && currentLine !== 0)
                screenChaser(screenLine);
            
            
            try {
                // audioPlay(currentLine);
                if(stringArray[currentLine] != undefined)
                    audioPlay2(stringArray[currentLine]);
                
                var musicLength = getMusicLength(endLine, tempo);
                var current     = getMusicLength(currentLine, tempo);
        
                    document.getElementById('input_musicLength').value = current+" / "+musicLength;
                
            } catch (e){
                console.log("음원 실행 오류");
            }


            if(currentLine + 1 >= endLine){
                window.clearInterval(audioHandler);
                
                var endTimer = setTimeout(function(){
                    removeFocus('line-focus');
                    audioHandler = undefined;
                    document.getElementById('musicscore').scrollTo(0,scrollY);
                    musicStop();
                    
                    
                    
                    
                },1000);
            }

            currentLine++;
        },tempo);

        buttonChange('button_play');
    }
);

$('#div_musicController').on('click','.btn-stop',function() {
    musicStop();
});

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

function musicStop(){
    stop_music();
    buttonChange('button_play');
    currentLine = 0;
    removeFocus('line-focus');
    $("#input_musicLength")[0].value = "";
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

//악보 새로 저장
$('#button_save_new').click(function() {
    sendScore();
    // 0413 민석 추가
    
})

//악보 덮어쓰기
$('#button_save_overwrite').click(function() {
    if(location.href.search('edit') > -1)
        overwriteScore();
    else
        sendScore();
})

//악보 제거하기
$('#button_delete').click(function() {
    deleteScore();
})


$('#button_tempo_change').click(function() {
    var point = parseInt(prompt("변동할 위치"));
    var tempo = parseInt(prompt("템포값"));
    var tempoElement = createTempoPoint(point,tempo);
    
    tempoArray[tempoArray.length] = tempoElement;
    
    
})
$(document).ready(function(){
$("#tempoModal").on('shown.bs.modal', function () {
    console.log('The modal is fully shown.');
    });
});

// ------------------------------------------------------------------------------

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


function audioPlay2(scoreString) {
    var scoreArray = getPlayList2(scoreString);
    var audio = "";
    var src = "";
    
    if(scoreArray != undefined){
        for(var i = 0; i < scoreArray.length; i++){
            
                src = "{{asset('wav/note')}}/note_"+scoreArray[i]+".wav";
                audio = new Audio(src);
                audio.play();
            
            
        }
    }
    else
        return 0;
}

function getPlayList2(scoreString){
    //"YA"를 받으면 그걸 분해해서 숫자로 바꾼 뒤 배열로 리턴
    
    var scoreArray;
    if(scoreString != ""){
        var scoreLength = scoreString.length;
        
        scoreArray = new Array(scoreLength);
        
        for(var i = 0; i < scoreLength; i++){
            scoreArray[i] = convertScoreStringToWaveNum(scoreString[i]);
        }
    }
    return scoreArray;
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
function getTempo(argTempo) {
    var inputTempo =    argTempo;

    if(inputTempo == "" || inputTempo <= 0)
        inputTempo = 80;

        inputTempo = 300 / inputTempo * 100 ;
        // 30 == 1000
        //

    return inputTempo;

}

function getMusicLength(endLine, tempo){
    var maxOfSecond = endLine * tempo / 1000;
    var h = Math.floor(maxOfSecond / 3600);
    var m = Math.floor(maxOfSecond / 60) - h * 60;
    var s = Math.ceil(maxOfSecond - h * 3600 - m * 60);
    var lengthString = h + ":" + m + ":" + s;
    
    return lengthString;
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

    var scoreString;

    
    var scoreInfoArray = readScoreFromDB();
    
    if(scoreInfoArray == 0)
        scoreString = prompt("악보 코드 입력");
    else
        scoreString = scoreInfoArray.scorestring;

    if(scoreString === "" || scoreString === null)
        return 0;

    clearScore();

    var tempo = scoreString.split(";")[0];
    var score = scoreString.split(";")[1].split("r");
    var convertScore = [];

    tableCreate(score.length + score.length%4 - 24);


    // console.log(score);

    for(var i = 0; i < score.length; i++) {
        if (!convertScore[i])
            convertScore[i] = [];


        for (var j = 0; j < score[i].length; j++) {

            var convertString = score[i][j].charCodeAt().valueOf();


            convertScore[i][j] = convertString;
        }
    }

    // tempo = getTempo(tempo);

    // console.log(tempo);
    // console.log(convertScore);

    $('#input_tempo')[0].value = tempo;

    for(var i = 0; i < convertScore.length; i++)
        for(var j = 0, k = 0; j < MAX_NOTES; j++){
            var currentScore = document.getElementById('tbodyOfPianoTable').children[j].children[i+1];
            if(currentScore.getAttribute('name') == convertScore[i][k] - 25) {
                currentScore.classList.add("cell-piano-input");
                
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
        if(!body.classList.contains('cell-piano-input'))
           body.classList.toggle('line-focus');
    }

}

//css를 이용한 현재 진행 척도 강조 해제
function removeFocus(focusName){
    var focusedLine = document.getElementsByClassName(focusName);

    while(focusedLine.length > 0){
        focusedLine[0].classList.remove(focusName);
    }
}

function screenChaser(line) {
    var cellWidth = document.getElementsByName('80')[0].offsetWidth;
    // document.getElementById('musicbox').scrollBy(cellWidth*currentLine,0);
    document.getElementById('musicscore').scrollBy(cellWidth*line,0);
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
            var tempTarget = target.parentElement.parentElement.children[i];
            
            if(!horizonElements.children[focusLine].classList.contains('cell-piano-input'))
                horizonElements.children[focusLine].classList.toggle('crossFocus');
            
    }
    
    
    }catch(e){
        
        
    }
}



function sendScore(){
    var scoreString = convertString(0);
    var tempo = scoreString.split(";")[0];
    var score = scoreString.split(";")[1];
    var title = document.getElementsByName('scoreTitle')[0].value;
    var category = document.getElementsByName('scoreCategory')[0].value;
    var comment = document.getElementsByName('scoreComment')[0].value;
    
    if(title == ""){
        alert('제목을 입력해주세요.');
        return -1;
    }
    
    if(category == ""){
        alert('장르를 선택해주세요.');
        return -1;
    }
    
    
    var token = "{{ csrf_token() }}";
    $.ajax({
        type: "POST",
        url: "{{route('main.store')}}",
        data: {tempo: tempo, score: score,title: title, category: category, comment: comment,_token:token},
        
        success: function( json ) {
            alert(json.msg);
            // alert(json.scorenum);
        scorenum = "/"+json.scorenum; 
        
        
        if(scorenum == '/undefined'){
        location.href = "../login";
        }
        else{
        history.replaceState({},"/main/create","/main"+scorenum+"/edit")
        //페이지 이동하시겠습니까?? YES/NO 창 필요.
        
        location.replace("{{route('getScore')}}");
        }
            
            
        }
    });
   
    
}




    
    


function readScoreFromDB(){
    
        var temp        = {!!json_encode($post);!!};
        var title       = temp.title;
        var category    = temp.category;
        var comment     = temp.comment;
        // var scoreString = temp.scorestring;
        
        if(title == undefined)
            title = "";
        if(category == undefined)
            category = "장르";
        if(comment == undefined)
            comment = "";        
    
    
        
        document.getElementsByName('scoreTitle')[0].value   = title;
        document.getElementsByName('scoreCategory')[0].value = category ;
        document.getElementsByName('scoreComment')[0].value = comment;
        
    
    //select 악보스트링 where 악보아이디 = scoreId    
    
    
    
    
    return temp;

}

//수정할 때 수정할 스코어 넘버가 필요해 
function overwriteScore(){
    
        //악보 덮어쓰기 함수
        //ID가 같은 score 정보를 현재의 정보로 덮어쓴다.
        var scoreString = convertString(0);
    
        //전송 정보 목록
        var tempo = scoreString.split(";")[0];
        var score = scoreString.split(";")[1];
        var title = document.getElementsByName('scoreTitle')[0].value;
        var category = document.getElementsByName('scoreCategory')[0].value;
        var comment = document.getElementsByName('scoreComment')[0].value;
    
        if(title == ""){
            alert('제목을 입력해주세요.');
            return -1;
        }
    
        if(category == "장르"){
            alert('장르를 선택해주세요.');
            return -1;
        }
        
    
    //DB로 쓩!
        var _method = "put";
        $.ajax({
            type: "POST",
            url: "{!! route('main.update',isset($post->score_id) ? $post->score_id : "")!!}"+scorenum,
            data: {tempo: tempo, score: score,title: title, category: category, comment: comment,_method:_method},
            //성공시 알림이 떠야하는데 jquery를 모르겠다...
            success: function( json ) {
                alert(json.msg);
                
                location.replace("{{route('getScore')}}");
                }
            });
        }
    
function deleteScore(){
    if(confirm("악보가 제거됩니다.\n\n정말로 삭제하시겠습니까?")){
        
        var scoreId = {!! isset($post->score_id) ? $post->score_id : 0 !!};
        
        
        
        if(scoreId > 0){
            var _method = "DELETE";
            $.ajax({
                type: "post",
                url: "{!!route('main.destroy',isset($post->score_id) ? $post->score_id : "")!!}",
                //score_id를 받아가서 해당 악보를 제거하는 행위가 필요. 해당 파일에서 삭제 실행자가 제작자인지도 검사할 것.
                data:{_method:_method},
                
                success: function( json ){
                    alert(json.msg);
                    location.href = "../../score";
                }
                
                
            });
        }
        else{
            return -1;
        }
    }
    else{
        alert("취소되었습니다.");
    }
}


// function reverseStringForMusicXML(MusicString){
//     var tempo = MusicString.split(";")[0];
//     var string = MusicString.split(";")[1];
//     var preventReverseArray = string.split("r");
//     var reveredString = [];
//     var newString = "";
    
//     for(var i = 0; i < preventReverseArray.length; i++){
//         if (!reveredString[i])
//             reveredString[i] = [];
        
//         reveredString[i] = preventReverseArray[i].split("").reverse().join("");
//     }
    
//     for(var i = 0; i < reveredString.length; i++){
        
//         var temp = reveredString[i];
//         for(var j = 0; j < temp.length; j++){
//             newString += temp[j];
//         }
//         newString += "r";
//     }
    
//     return tempo +";"+ newString;
// }
    
    function createTempoPoint(argPoint, argTempo){
        var tempoArrayElement = {point:argPoint,tempo:getTempo(argTempo)};
        
        return tempoArrayElement;
    }
    
    
    
</script>
    
@stop

