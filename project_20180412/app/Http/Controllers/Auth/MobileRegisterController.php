<?php

namespace App\Http\Controllers\Auth;
use DB;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class MobileRegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    //가입 페이지 이동
    protected function getRegister()
    {
        return view('user.register');
    }
    //가입 실행
    protected function postRegister(Request $request)
    {
        $name = $request->get('name');
        $userName = DB::table('users')->where('name', $name)->value('name');
        //중복 아이디 검사
        if($userName == null){
            //중복 아이디가 없을때
            $nameCheck['check'] = true;
        }
        else{
            //중복 아이디가 있을때
            $nameCheck['check'] = false;
            return json_encode($nameCheck);
        }

        //중복아이디가 없을 때
        if($nameCheck == true) {
            $post = new User();
            $post->name = $request->get('name');
            $post->password = $request->get('password');
            $post->email = $request->get('email');
            $post->save();

            $user = DB::table('users')->where('name', $request->get('name'))->get();

            if ($user != null) {
                $save['save'] = true;
            } else {
                $save['save'] = false;
            }
            return json_encode($save);
        }

    }

}

