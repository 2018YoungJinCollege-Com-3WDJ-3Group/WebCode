@extends('layouts.master')
@section('content')
<h1>모바일 환경입니다.</h1>
    <form method="post" action="{{route('postMLogin')}}">
    <!-- <input type="hidden" name="_token" value="{{csrf_token()}}"/>-->
        <label for="id">로그인아이디</label>
        <input type='text' name='name' value="{{old('name')}}">
        <!--button onclick="name_check()">중복체크</button>-->
        <label for="password">패스워드</label>
        <input type="password" name="password" value="{{old('password')}}"/>
        <input type="submit" value='로그인하기'/>
    </form>
    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign"></span>
            <span class="sr-only">Error:</span>
            @foreach($errors->all() as $message)
                {{$message}}
            @endforeach
        </div>
    @endif
    <a href="{{route('getMRegister')}}">가입하기</a>

@stop