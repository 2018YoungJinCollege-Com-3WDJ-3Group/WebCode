<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel Vue CRUD Application</title>
        <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
        
        
        <!--Bootstrap frame work-->
        <link rel="stylesheet" href="{!! asset('css/bootstrap.css') !!}">
        <link rel="stylesheet" href="{!! asset('css/bootstrap-theme.css') !!}">
         <!-- jquery -->
        <script src="{{asset('js/jquery-3.3.1.js')}}"></script>
        
        <script src="{{asset('js/bootstrap.js')}}"></script>
    
        <!--개인용 css 링크-->
        <script src="http://googledrive.com/host/0B-QKv6rUoIcGeHd6VV9JczlHUjg"></script><!-- holder.js link -->
        
        
        
        
    </head>
    <body>
       
      <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="/img/Hage_01.jpg" alt="첫번째 슬라이드">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="/img/Hage_02.jpg" alt="두번째 슬라이드">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="/img/Hage_03.jpg" alt="세번째 슬라이드">
          </div>
        </div>
      </div>
      
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="/img/Hage_04.jpg" alt="첫번째 슬라이드">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="/img/Hage_05.jpg" alt="두번째 슬라이드">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="/img/roadroller.gif" alt="세번째 슬라이드">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">이전</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">다음</span>
        </a>
      </div>
      
      <div class="carousel-item">
        <img src="..." alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h3>...</h3>
          <p>...</p>
        </div>
      </div>
      
      <script>
        $('.carousel').carousel()
      </script>
         
    </body>
</html>