//for Share Board Functions

var audioHandler;
var currentLine = 0;

function play_music(scoreString){
    window.clearInterval(audioHandler);
    currentLine = 0;
    
    
    var tempo = 300 / scoreString.split(";")[0] * 100;
    var ArrayOfScoreString = scoreString.split(";")[1].split("r");
    
    var endLine = ArrayOfScoreString.length - 1;
    
    audioHandler = setInterval(function (){
        
        var currentMelody = ArrayOfScoreString[currentLine];
        
        try{
        for(var i = 0; i < currentMelody.length; i++){
            var note = convertScoreStringToWaveNum(currentMelody[i]);
            play_audio(note);
            // console.log("작동 중");
        }
        }
        catch(e){
            console.log("error catch");
        }
        
        
        
        
        if(currentLine == endLine){
            window.clearInterval(audioHandler);
            currentLine = 0;
            setTimeout(function(){
                buttonChange(document.getElementsByClassName('btn-stop')[0].id);
            },2000);
        }
        else{
            currentLine++;
        }
    },tempo);
    
    
    // console.log(ArrayOfScoreString);
}

function convertScoreStringToWaveNum(argString) {
    return argString.charCodeAt()-25;
}

function play_audio(noteNum) {
    var src = "../wav/note/note_"+noteNum+".wav";
    
    var audio = new Audio(src);
    audio.play();
    return;
}

function buttonChange(targetId){
    var target = document.getElementById(targetId);
    var previousTarget = document.getElementsByClassName('btn-stop')[0];
    
    if(previousTarget != undefined && target != previousTarget){
        previousTarget.classList.toggle("btn-play");
        previousTarget.classList.toggle("btn-stop");
        previousTarget.innerText = "▶";
    }
    
    
    
    target.classList.toggle("btn-play");
    target.classList.toggle("btn-stop");
    
    if(target.classList.contains("btn-play"))
        target.innerText = "▶";
    else {
        
        target.innerText = "■";
    }
}

function stop_music() {
    window.clearInterval(audioHandler);
    
}