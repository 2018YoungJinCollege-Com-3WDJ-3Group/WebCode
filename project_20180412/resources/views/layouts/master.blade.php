<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">

    <!--Bootstrap frame work-->
    <link rel="stylesheet" href="{!! asset('css/bootstrap.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/bootstrap-theme.css') !!}">
     <!-- jquery -->
    <script src="{{asset('js/jquery-3.3.1.js')}}"></script>
    
    <script src="{{asset('js/bootstrap.js')}}"></script>

    <!--개인용 css 링크-->
    <link rel="stylesheet" href="{!! asset('css/personal.css?ver=5') !!}">
    
    <!-- test -->
   
    
    <!-- main.index.blade.php CSS -->
    <style>
        
        
        
    </style>
    
    
    
    <div>　</div>
    <div class="container-fluid" style="margin: auto;">
        <div class="row">
            
            <!-- logotype -->
            <span class="col-md-2">
                <a href="{{ url('/') }}"><img src="/img/logotype_icon.png?ver=9" style="width:168px;height:57px"></img></a>
            </span>
            
            <!-- search -->
            <span class="col-md-4">
                <span>
                    <form class="row form-group-sm search-tool" method="get" action="">
                        
                        <div class="col-sm-10">
                            <input class="form-control col-sm-2" style="background: transparent; border: 0px; font-size: 15px;" type="text" name="search">    
                        </div>
                        <div class="col-sm-2" align="right">
                            <img src="/img/search_icon_resized32px.png"></img>
                        </div>
                    
                    </form>    
                </span>
            
                    
            
            </span>
            
            <!-- login & logout -->
            <span class="col-md-6">
                <div class="user_icon">
            
                    @if(session()->get('is_login'))
                    <a href="{{route('getLogout')}}">
                    <div class="col-md-2">
                        
                            <div>
                                <img src="/img/logout_icon_resized50px.png">
                            </div>
                            <div>
                                Sign Out
                            </div>
                        
                    </div>
                    </a>
                    
                    <a href="{{route('myinfo')}}">
                    <div class="col-md-2">
                        
                            <div>
                                <img src="/img/myInfo_icon_resized50px.png">
                            </div>
                            <div>
                                My Info
                            </div>
                        
                    </div>
                    </a>
                    <a href="{{route('getScore')}}">
                    <div class="col-md-2">
                    
                            <div>
                                <img src="/img/op_folder_icon_resized50px.png">
                            </div>
                            <div>
                                My Score
                            </div>
                        
                    </div>
                    </a>
                    <div class="point_message col-md-3" style="text-align:center">
                        <div>
                            @php    
                                echo "「".session()->get('user_name')."」님 환영합니다.";
                            @endphp
                        </div>
                        <div>
                            @php
                                echo " 잔여 포인트 : ".session()->get('point')."P";
                            @endphp
                        </div>
                    </div>
                    
                    
                    
                    @else
                   
                    <a href="{{route('getLogin')}}">
                    <div class="col-md-2">
                    
                        <div>
                            <img src="/img/login_icon.png">
                        </div>
                        <div>
                            Sign In
                        </div>
                    
                    </div>
                    </a>
                    
                    @endif
                    
                </div>
            </span>
            <!-- image size : 50px -->
            
        </div>
    </div>
    
    
    
</head>
<body>
  
  
   <div class="content">
        
       
        
        <!-- image size : 75px -->
        <div class="menu_icon row">
            <a href="{{route('main.index')}}">
            <div class="col-md-2 center">
                
                    <div><img src="/img/mk_score_icon_resized75px.png"></div>
                    <div>Create Score</div>
                
            </div>
            </a>
            <a href="{{route('Share.index')}}">
            <div class="col-md-2 center">
                
                    <div><img src="/img/dl_file_icon_resized75px.png"></div>
                    <div>Shared Score</div>
                
            </div>
            </a>
            <a href="#">
            <div class="col-md-2 center">
                
                    <div><img src="/img/trophy_icon_resized75px.png"></div>
                    <div>Ranking</div>
                
            </div>
            </a>
            <a href="{{route('Post.index')}}">
            <div class="col-md-2 center">
                
                    <div><img src="/img/community_icon_resized75px.png"></div>
                    <div>Community</div>
                
            </div>
            </a>
            <a href="#">
            <div class="col-md-2 center">
                
                    <div><img src="/img/helping_icon_resized75px.png"></div>
                    <div>Service Center</div>
                
            </div>
            </a>
            
        </div>
        
        @yield('content')

    </div>
</body>
</html>


