<html>
    <body>
        <form method="post" action="{{route('login.store')}}">
             <!--<input type="hidden" name="_token" value="{{csrf_token()}}">-->
            <label>로그인아이디</label>
            <input type='text' name='name'>
            <label for="password">패스워드</label>
            <input type="password" name="password"/>
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
    </body>
</html>