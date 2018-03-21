<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">

    <!--Bootstrap frame work-->
    <link rel="stylesheet" href="{!! asset('css/bootstrap.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/bootstrap-theme.css') !!}">
    <script src="{{asset('js/bootstrap.js')}}"></script>

    <!--개인용 css 링크-->
    <link rel="stylesheet" href="{!! asset('css/persnoal.css?ver=5') !!}">
    
    
    
    
    
    <style>
        .content {
            text-align: center;
        }
        .user_icon{
            text-align: right;
        }
    </style>
</head>
<body>
<div class="content" style="margin: auto;">
    <div style="margin: auto;">
        <a href="{{ url('/') }}"><img src="/img/logotype_icon.png"></img></a>
    </div>
    
    <!-- image size : 75px -->
    <div class="user_icon">
        <a href="https://placeholder.com"><img src="/img/op_folder_icon_resized50px.png"></a>
        <a href="https://placeholder.com"><img src="/img/myInfo_icon_resized50px.png"></a>
        <a href="https://placeholder.com"><img src="/img/logout_icon_resized50px.png"></a>
    </div>
    
    <div>
        <form method="get" action="{{route('sellboard.search')}}">
        <select name="search_tag">
                        <option value="1">제목</option>
                        <option value="2">내용</option>
                        <option value="3">저작자</option>
                        
        </select>
        <input type="text" name="search"><input type="submit" value="검색하기">
        </form>
    </div>
    
    <!-- image size : 75px -->
    <div class="menu_icon">
        <a href="{{route('main.index')}}"><img src="/img/mk_score_icon_resized75px.png"></a>
        <a href="{{route('sellboard.index')}}"><img src="/img/dl_file_icon_resized75px.png"></a>
        <a href="https://placeholder.com"><img src="/img/trophy_icon_resized75px.png"></a>
        <a href="https://placeholder.com"><img src="/img/community_icon_resized75px.png"></a>
        <a href="https://placeholder.com"><img src="/img/helping_icon_resized75px.png"></a>
    </div>
    
    @yield('content')
</div>
</body>
</html>


