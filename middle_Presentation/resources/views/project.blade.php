@extends('layouts.master')
@section('content')
<style type="text/css">
    .blankDiv{
        display : none;
    }
</style>
<div id="myCarousel" class="carousel container slide">
<div class="carousel-inner">
        <div class="active item one"></div>
        <div class="item two"></div>
        <div class="item three"></div>
        <div class="item four"></div>
        
        <div align="center">
            <input type="radio"/>
            <input type="radio"/> 
            <input type="radio"/>
        </div>
</div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('.carousel').carousel({interval: 7000});
  });
</script>
@stop