@extends('layouts.master')
@section('content')

    
    <!-- --------------------------------------------------------------
    
    -------------------- / main / index.blade.php ---------------------
    
    --------------------------------------------------------------- -->
    
    

   
    
    <div class="baseBoard">
        <!--악보 작성-->
        <a href="{{route('main.create')}}"><div style="display:inline-block;"><img src="/img/createScore.png"></div></a>
        <!--악보 수정-->
        <a href="/score"><div style="display:inline-block;"><img src="/img/editScore.png"></div></a>
        <!--악보 변환 클릭시 파일 선택창 팝업-->
        <div id="dropzone" class='drop-zone' style="width:200px; height:200px; display:inline-block; padding-top:88px;">
            drag & drop<br>(*.musicXML)</div>
       
    </div>
    
    
    
<script>

    // XML DOM Obj
    var xmlDOM;


    // get XMLHttpReaquest
    function getXMLHttp() {

        var xmlhttp = null;

        // Chrome else..
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } // explorer
        else if (window.ActiveXObject) {// IE
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        return xmlhttp;
    }

    // get XML DOM
    function getXMLDOM(Url,Option,SearchValue) {

        var xmlhttp = getXMLHttp();
        var templateStr = null;
        var Async = false;


        if (Option == "TRUE") {
            Async = true;
        }


        // select option
        if (Option == "POST") {
            xmlhttp.open("POST",Url,Async);
            xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        }
        else {
            xmlhttp.open("GET",Url,Async);
        }

        xmlhttp.onreadystatechange = function () {

            if(xmlhttp.readyState == "4") {
                xmlDoc = xmlhttp.responseXML;
            }
        }

        xmlhttp.send();
        return xmlDoc;

    }

    // get Tempo
    function getTempo(xmlDOM) {

        var dom = xmlDOM;

        if(dom.getElementsByTagName("sound").length > 0){

            var tempoDom = dom.getElementsByTagName("sound");
            var tempo = tempoDom[0].getAttribute("tempo")

            return tempo;
        }
        return 80;
    }

    // get Divisions -  quarter note's duration
    function getDivisions(xmlDOM) {

        var dom = xmlDOM;
        var divisions = dom.getElementsByTagName("divisions");
        var dLength = divisions.length;

        return divisions[0].childNodes[0].nodeValue;

    }

    // get tagLength - counting tag
    function getDomLength(xmlDom,tagName) {
        try {
            return xmlDom.getElementsByTagName(tagName).length;

        }
        catch (e) {
            return xmlDom.getElementsByTagName(tagName).length;
        }
    }



    // Main Function
    // Url = file location
    //
    function getMeasureInfo(Url) {

        xmlDOM = getXMLDOM(Url);

        var str = "";
        var restLength = 0;
        var noteDuration = 0;
        var division = getDivisions(xmlDOM);

        // get measureDOM from xmlDOM
        var measureObj = xmlDOM.getElementsByTagName("measure");

        for(key in measureObj){

            if(!isNaN(key)){

                // get noteDOM from measureDOM
                var nt = measureObj[key].getElementsByTagName("note");

                for(key2 in nt) {

                    if( !isNaN(key2) ){

                        if(nt[key2].childNodes[1].nodeName == "pitch"){
                            str += "r";
                            for(var i = 0 ; i < restLength -1 ; i++){
                                str += "r";
                            }
                        }

                        if(nt[key2].childNodes[1].nodeName == "chord") {

                            noteDuration = nt[key2].childNodes[5].childNodes[0].nodeValue;

                            if(noteDuration >= division){
                                restLength = (nt[key2].childNodes[5].childNodes[0].nodeValue / division) * 2;
                            } else {
                                restLength = 0;
                            }

                            if(nt[key2].childNodes[3].childNodes[3].nodeName == "alter"){

                                var nStep = nt[key2].childNodes[3].childNodes[1].childNodes[0].nodeValue;
                                var nOtav = nt[key2].childNodes[3].childNodes[5].childNodes[0].nodeValue+" ";
                                var nAlt = nt[key2].childNodes[3].childNodes[3].childNodes[0].nodeValue+" ";
                                var noteInfo ;

                                if(nAlt == 1){
                                    switch (nStep){
                                        case "C"    : noteInfo = "C"+nOtav+"#";break;
                                        case "D"    : noteInfo = "D"+nOtav+"#";break;
                                        case "E"    : noteInfo = "E"+nOtav;break;
                                        case "F"    : noteInfo = "F"+nOtav+"#";break;
                                        case "G"    : noteInfo = "G"+nOtav+"#";break;
                                        case "A"    : noteInfo = "A"+nOtav+"#";break;
                                        case "B"    : noteInfo = "C"+(nOtav+1);break;
                                            break;
                                    }
                                } else{
                                    switch (nStep){
                                        case "C"    : noteInfo = "A"+(nOtav-1);break;
                                        case "D"    : noteInfo = "C"+nOtav+"#";break;
                                        case "E"    : noteInfo = "D"+nOtav+"#";break;
                                        case "F"    : noteInfo = "E"+nOtav;break;
                                        case "G"    : noteInfo = "F"+nOtav+"#";break;
                                        case "A"    : noteInfo = "G"+nOtav+"#";break;
                                        case "B"    : noteInfo = "A"+nOtav+"#";break;
                                            break;
                                    }
                                }
                                str += noteInfo;

                            }else {

                                str += nt[key2].childNodes[3].childNodes[1].childNodes[0].nodeValue;
                                str += nt[key2].childNodes[3].childNodes[3].childNodes[0].nodeValue;

                            }
                        } else if(nt[key2].childNodes[1].nodeName == "pitch") {

                            noteDuration = nt[key2].childNodes[3].childNodes[0].nodeValue;

                            if(noteDuration >= division){
                                restLength = (nt[key2].childNodes[3].childNodes[0].nodeValue / division) * 2;
                            } else {
                                restLength = 0;
                            }

                            if(nt[key2].childNodes[1].childNodes[3].nodeName == "alter"){

                                var nStep = nt[key2].childNodes[1].childNodes[1].childNodes[0].nodeValue;
                                var nOtav = nt[key2].childNodes[1].childNodes[5].childNodes[0].nodeValue;
                                var nAlt = nt[key2].childNodes[1].childNodes[3].childNodes[0].nodeValue;

                                if(nAlt == 1){
                                    switch (nStep){
                                        case "C"    : noteInfo = "C"+nOtav+"#";break;
                                        case "D"    : noteInfo = "D"+nOtav+"#";break;
                                        case "E"    : noteInfo = "F"+nOtav;break;
                                        case "F"    : noteInfo = "F"+nOtav+"#";break;
                                        case "G"    : noteInfo = "G"+nOtav+"#";break;
                                        case "A"    : noteInfo = "A"+nOtav+"#";break;
                                        case "B"    : noteInfo = "C"+(nOtav+1);break;
                                            break;
                                    }
                                } else{
                                    switch (nStep){
                                        case "C"    : noteInfo = "B"+(nOtav-1);break;
                                        case "D"    : noteInfo = "C"+nOtav+"#";break;
                                        case "E"    : noteInfo = "D"+nOtav+"#";break;
                                        case "F"    : noteInfo = "E"+nOtav;break;
                                        case "G"    : noteInfo = "F"+nOtav+"#";break;
                                        case "A"    : noteInfo = "G"+nOtav+"#";break;
                                        case "B"    : noteInfo = "A"+nOtav+"#";break;
                                            break;
                                    }
                                }
                                str += noteInfo;

                            } else {

                                str += nt[key2].childNodes[1].childNodes[1].childNodes[0].nodeValue;
                                str += nt[key2].childNodes[1].childNodes[3].childNodes[0].nodeValue;

                            }

                        } else if(nt[key2].childNodes[1].nodeName == "rest") {

                            var rest = (nt[key2].childNodes[3].childNodes[0].nodeValue / division) * 2;

                            for(var i = 0 ; i < rest ; i++){
                                str += "r";
                            }

                        } else{

                        }
                    }
                }
                // str += "<br>";
            }
        }

        str = str.replace(/C3/g,"A");
        str = str.replace(/D3/g,"C");
        str = str.replace(/G3/g,"H");
        str = str.replace(/A3/g,"J");
        str = str.replace(/B3/g,"L");
        str = str.replace(/C4/g,"M");
        str = str.replace(/D4/g,"O");
        str = str.replace(/E4/g,"Q");
        str = str.replace(/F4#/g,"S");
        str = str.replace(/F4/g,"R");
        str = str.replace(/G4#/g,"U");
        str = str.replace(/G4/g,"T");
        str = str.replace(/A4#/g,"W");
        str = str.replace(/A4/g,"V");
        str = str.replace(/B4/g,"X");
        str = str.replace(/C5#/g,"Z");
        str = str.replace(/C5/g,"Y");
        str = str.replace(/D5#/g,"\\");
        str = str.replace(/D5/g,"[");
        str = str.replace(/E5/g,"]");
        str = str.replace(/F5#/g,"_");
        str = str.replace(/F5/g,"^");
        str = str.replace(/G5#/g,"a");
        str = str.replace(/G5/g,"\`");
        str = str.replace(/A5#/g,"c");
        str = str.replace(/A5/g,"b");
        str = str.replace(/B5/g,"d");
        str = str.replace(/C6/g,"e");
        str = str.replace(/D6/g,"g");
        str = str.replace(/E6/g,"i");

        var total_str = getTempo(xmlDOM)+";"+str;
        return reverseStringForMusicXML(total_str);

    }
    
    // String reverser
    function reverseStringForMusicXML(MusicString){
        var tempo = MusicString.split(";")[0];
        var string = MusicString.split(";")[1];
        var preventReverseArray = string.split("r");
        var reveredString = [];
        var newString = "";

        for(var i = 0; i < preventReverseArray.length; i++){
            if (!reveredString[i])
                reveredString[i] = [];

            reveredString[i] = preventReverseArray[i].split("").reverse().join("");
        }

        for(var i = 0; i < reveredString.length; i++){

            var temp = reveredString[i];
            for(var j = 0; j < temp.length; j++){
                newString += temp[j];
            }
            newString += "r";
        }

        return tempo +";"+ newString;
    }

    // session File Path

    // var sesstion_URL ;
    //
    // if(window.sessionStorage){
    //     sesstion_URL = sessionStorage.getitem("FIle_path");
    // }


    function goPost(XMLString,URL) {

        var POST_URL = URL;
        var XML_String = XMLString;
         
        //    var obj1 = document.getElementsByName('col1')[0].value;
        
        //    var obj2 = document.getElementsByName('col2')[0].value;
        

        var form = document.createElement("form");
        
        form.setAttribute("charset", "UTF-8");
        
        form.setAttribute("method", "Post"); // Get 또는 Post 입력
        
        form.setAttribute("action", POST_URL);
        
        
        var hiddenField = document.createElement("input");
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", "XML_String");
        hiddenField.setAttribute("value", XML_String);
        
        form.appendChild(hiddenField);
        
        document.body.appendChild(form);
        
         
         
        form.submit();

}

    

    
    
        // Files Drag & Drop function 
        $(function () {
            var obj = $("#dropzone");

            obj.on('dragenter', function (e) {
                e.stopPropagation();
                e.preventDefault();
                // $(this).css('border', '4px solid #5272A0');
            });

            obj.on('dragleave', function (e) {
                e.stopPropagation();
                e.preventDefault();
                // $(this).css('border', '4px dotted #8296C2');
            });

            obj.on('dragover', function (e) {
                e.stopPropagation();
                e.preventDefault();
            });

            obj.on('drop', function (e) {
                e.preventDefault();
                // $(this).css('border', '4px dotted #8296C2');

                // files to transfer
                var files = e.originalEvent.dataTransfer.files;
                if(files.length < 1) {
                    return;
                }
                // multiUploading
                F_FileMultiUpload(files, obj);
            });
            
            // ------------------------ Please add on onclick Event ------------------------
            obj.on('onclick', function(e) {
                e.preventDefault();
                // $(this).css('border', '2px dotted #8296C2');
                var files = e.originalEvent.dataTransfer.files;
                if(files.length < 1) {
                    return;
                }
            })

        });

        // Files MultiUpload Function
        function F_FileMultiUpload(files, obj) {
            
            // pathHeader = obj.lastIndexOf("\\");
        //     pathMiddle = files[0].lastIndexOf(".");
            pathEnd = files.length;
            // fileName = files[0].substring(pathHeader+1, pathMiddle);
            // extName = files[0].substring(pathMiddle+1, pathEnd);
            // allFilename = fileName+"."+extName;
            
            
            if(confirm(files.length + "개의 파일을 업로드 하시겠습니까?") ) {
                var data = new FormData();
                for (var i = 0; i < files.length; i++) {
                    data.append('file', files[i]);
                }

                var url = "{{route('upload')}}";
                $.ajax({
                    url: url,
                    method: 'post',
                    data: data,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        //파일 위치 알려줌
                        //alert(res.file_path);
                        
                        
                        var XML_String = getMeasureInfo(res.file_path);
                        goPost(XML_String,"{{route('main.xml')}}");
                        
                        // alert(XML_String);
                    }
                });
                //외부 악보 
                
                
            }
        }

        // Files Multi Upload Callback Function
        function F_FileMultiUpload_Callback(files) {
             for(var i=0; i < files.length; i++)
                 console.log(files[i].file_nm + " - " + files[i].file_size);
        }

        function eventOccur(evEle, evType){
            if (evEle.fireEvent) {
                evEle.fireEvent('on' + evType);
            } else {
                
                // MouseEvents
                // Don`t Just Events
                var mouseEvent = document.createEvent('MouseEvents');
                /* API Documenet - initEvent(type,bubbles,cancelable) */
                mouseEvent.initEvent(evType, true, false);
                var transCheck = evEle.dispatchEvent(mouseEvent);
                if (!transCheck) {
                    // if Events failed...
                    console.log("Click Events failed..!");
                }
            }
        }
        
        function check(){
            eventOccur(document.getElementById('orgFile'),'click');
            /* alert(orgFile.value); 이벤트 처리가 끝나지 않은 타이밍이라 값 확인 안됨! 시간차 문제 */
        }


        



    </script>
 
    
@stop