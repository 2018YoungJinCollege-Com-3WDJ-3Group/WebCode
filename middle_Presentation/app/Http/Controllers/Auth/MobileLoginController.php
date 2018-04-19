<?php
namespace App\Http\Controllers\Auth;
use DB;
use Session;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class MobileLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $loginPath ='/login_m';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        //$this->middleware('guest')->except('Logout');
        //$this->middleware('guest')->except('Login');
    }
    //모바일 로그인 페이지 불러오기
    public function getLogin()
    {
        return view('user.login_m');
    }
    //로그인 실행 하기
    public function postLogin(Request $request)
    {
        //

        $name=$request->get('name');
        $password=$request->get('password');
        $user=DB::table('users')->where([['name', $name],['password',$password]])->first();
        if($user!=null)
        {

            $request->session()->regenerate();
            //모바일
            $s_id=session()->getId();
            $request->session()->put('user_name',$user->name);
            $request->session()->put('user_id',$user->id);
            $request->session()->put('point', $user->point);
            
            $arr=array('check'=>true,'session_id'=>$s_id);
            //모바일 session_id저장
            $post=User::findOrFail($user->id);
            $post->session_id=$s_id;
            $post->save();
            
            $result=array_merge($arr,(array)$user);
            
            return json_encode($result);

        }
        else{
            //모바일
            $result=array('check'=>false);
            return json_encode($result);
        }
    }
    //모바일 로그아웃.
    public function getLogout(Request $request){
        $request->session()->put('is_login', false);
        return redirect('/');
    }


}
