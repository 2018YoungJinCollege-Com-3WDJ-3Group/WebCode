<?php

namespace App\Http\Controllers\Auth;
use DB; 
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
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
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    //가입 페이지 이동
    protected function getRegister()
    {
        return view('user.register');
    }
    //가입 실행
    protected function postRegister(Request $request)
    {
        $validator=Validator::make($request->all(),User::$rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        
        $post=new User();
        $post->name=$request->get('name');
        $post->password=$request->get('password');
        $post->email=$request->get('email');
         $post->save();
         $user = DB::table('users')->where('name',  $post->name)->first();
         $temp=json_encode($user); 
         return redirect('/'); 
    }
    //중복확인 실행
    protected function namecheck(Request $request)
    {
        $name=$request->get('name');
        $bool=DB::table('users')->where('name', $name)->exists();
        if($bool==true){
            //모바일
            /*$arr=array('exists'=>true);
            return json_encode($arr);*/
        }
        else{
        /*모바일
        $arr=array('exists'=>false);
            return json_encode($arr);*/
        }
    }
}
