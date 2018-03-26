@extends('layouts.master')
@section('content')
    
    <script>
        function pop_up() {
            alert('팝업');
        }
    </script>
    
    
    <div style='height:200px;display:inline;margin:auto;'>
        <!--악보 작성-->
        <div style='display:inline;'><a href="{{route('main.create')}}"><img src="http://via.placeholder.com/200x200"></a></div>
        <!--악보 수정-->
        <div style='display:inline;'></div><a href="https://placeholder.com"><img src="http://via.placeholder.com/200x200"></a></div>
        <!--악보 변환 클릭시 파일 선택창 팝업-->
        <div id="dropzone" class='drop-zone'> Drag & Drop MusicXML File</div>
    </div>
    
    <script>
    
        // Files Drag & Drop function 
        $(function () {
            var obj = $("#dropzone");

            obj.on('dragenter', function (e) {
                e.stopPropagation();
                e.preventDefault();
                $(this).css('border', '4px solid #5272A0');
            });

            obj.on('dragleave', function (e) {
                e.stopPropagation();
                e.preventDefault();
                $(this).css('border', '4px dotted #8296C2');
            });

            obj.on('dragover', function (e) {
                e.stopPropagation();
                e.preventDefault();
            });

            obj.on('drop', function (e) {
                e.preventDefault();
                $(this).css('border', '4px dotted #8296C2');

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
                $(this).css('border', '2px dotted #8296C2');
                
            })

        });

        // Files MultiUpload Function
        function F_FileMultiUpload(files, obj) {
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
                        F_FileMultiUpload_Callback(res.files);
                    }
                });
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
                /* API문서 initEvent(type,bubbles,cancelable) */
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