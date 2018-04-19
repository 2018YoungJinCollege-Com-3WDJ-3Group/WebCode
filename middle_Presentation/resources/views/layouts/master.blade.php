<!doctype html>
<head>
    <meta charset="UTF-8">
    <!--Bootstrap frame work-->
    <link rel="stylesheet" href="{!! asset('css/bootstrap.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/bootstrap-theme.css') !!}">
     <!-- jquery -->
    <script src="{{asset('js/jquery-3.3.1.js')}}"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    <!--개인용 css 링크-->
    <link rel="stylesheet" href="{!! asset('css/personal.css?ver=8') !!}">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{!! asset('css/menuli.css?ver=5') !!}">
    <!-- test -->
    
    <!-- main.index.blade.php CSS -->
    <style>
    </style>
</head>
<body>
       <div class="navigationBar"> <!--네비게이션-->
        <div class="menuli cl-effect-5">
        <a href="{{ url('/') }}"><img src="/img/logo.png" style="width:200px;height:80px"></img></a>
        <a href="{{route('main.index')}}"><span data-hover="악보작성">&nbsp;&nbsp;Create&nbsp;&nbsp;</span></a>
        <a href="{{route('Share.index')}}"><span data-hover="악보공유">&nbsp;&nbsp;Share&nbsp;&nbsp;</span></a>
        <a href="#"><span data-hover="랭킹">Ranking</span></a>
        <a href="{{route('Post.index')}}"><span data-hover="커뮤니티"> Community </span></a>
        <a href="#"><span data-hover="안내">About</span></a>
        <a href="#"></a>
        @if(session()->get('is_login'))
        <a href='#'></a>
        <div class="dropdowns">
            <button class="dropbtns"><span class="glyphicon glyphicon-cog fa-lg"></span>&nbsp;
                    <i class="fa fa-caret-down"></i>
                </button>
            <div class="dropdowns-content">
              <a href="{{route('myinfo')}}">@php echo session()->get('user_name') @endphp &nbsp;<i class="fa fa-cog fa-lg"></i></a>
              <a href="#"> Point : @php echo session()->get('point')."P"; @endphp </a>
              <a href="{{route('getScore')}}"> 내 악보</a>
              <a href="{{route('getLogout')}}"><span class="glyphicon glyphicon-off"></span> Sign Out</a>
            </div>
        </div>
        @else
        <a href="{{route('getLogin')}}">Sign In</a>
        <a href="{{route('getLogin')}}">New Account<span class="glyphicon glyphicon-plus-sign fa-lg"></span></a>
        
        @endif
        </div>
    </div>
    <div class="blankDiv">
    
</div>

    
 


<!--<nav class="navbar navbar-custom">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="{{ url('/') }}"><img src="/img/logo.png?ver=9" style="width:200px;height:80px"></img></a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="{{route('main.index')}}">악보작성</a></li>
      <li><a href="{{route('Share.index')}}">악보공유</a></li>
      <li><a href="#">랭킹</a></li>
      <li><a href="{{route('Post.index')}}">커뮤니티</a></li>
      <li><a href="#">고객센터</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        @if(session()->get('is_login'))
        <li><a href="{{route('getLogout')}}"><span class="glyphicon glyphicon-off"></span> 로그아웃</a></li>
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">내 정보 <span class="caret"></span>
                <ul class="dropdown-menu">
                    <li><a href="{{route('myinfo')}}"><span class="glyphicon glyphicon-user"></span> @php echo session()->get('user_name') @endphp</a></li>
                    <li><a href="#">잔여 포인트 : @php echo session()->get('point')."P"; @endphp</a></li>
                    <li class="divider"><a href="#"></a></li>
                    <li><a href="{{route('getScore')}}">내 악보</a></li>
                    <li class="divider"><a href="#"></a></li>
                </ul>
            </li></a></li>
        @else
            <li><a href="{{route('getLogin')}}"><span class="glyphicon glyphicon-user"></span> 로그인</a></li>
            <li><a href="{{route('getLogin')}}"><span class="glyphicon glyphicon-user"></span> 회원가입</a></li>
        @endif
    </ul>
    </div>
    </nav>
   --><div>
       @yield('content')
       </div>
   </body>

</html>


