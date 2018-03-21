<html>
    <body>
        <form method="post" action="{{route('duplication')}}">
             <!--<input type="hidden" name="_token" value="{{csrf_token()}}">-->
            <label>로그인아이디</label>
            <input type='text' name='name'>
            <button onclick="name_check()">중복체크</button>
            <label>email</label>
            <input type='text' name='email'>
            <label for="password">패스워드</label>
            <input type="password" name="password"/>
            <input type="submit" value='가입하기'/>
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
    </body>
</html>