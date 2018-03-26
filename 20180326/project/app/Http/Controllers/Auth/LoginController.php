<?php
namespace App\Http\Controllers\Auth;
use DB; 
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
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
    protected $loginPath ='/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        session_start();
        $this->middleware('guest')->except('logout');
    }
    public function getLogin()
    {
        return view('user.login');
    }
     public function postLogin(Request $request)
    {
        //
            
        $name=$request->get('name');
        $password=$request->get('password');
        $bool=DB::table('users')->where([['name', $name],['password',$password]])->exists();
        
        if($bool)
        {   
           $request->session()->put('is_login', true);
            $user = DB::table('users')->where('name',  $name)->first();
            $request->session()->put('user_name',$user->name);
            $request->session()->put('user_id',$user->id);
            return redirect('/');
            
            /*//모바일
            $s_id=session_id();
            $arr=array('check'=>$bool,'session_id'=>$s_id);
            
            $user = DB::table('users')->where('name',  $name)->first();
            
            $result=array_merge($arr,(array)$user);
            return json_encode($result); 
            */
        }
        else{
            return redirect('/login');
            
            /*//모바일
            $result=array('check'=>$bool);
            return json_encode($result);*/
        }
    }
    public function getLogout(Request $request){
            $request->session()->put('is_login', false);
            return redirect('/');
    }
    
    
}
