<?php
namespace App\Http\Controllers\Auth;
use DB; 
use Session;
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
        $this->middleware('guest')->except('logout');
    }
    public function getLogin()
    {
        return view('user.login');
    }
     public function postLogin(Request $request)
    {
        //
        //세션 재시작&user session_id 저장
        $request->session()->regenerate();
        $name=$request->get('name');
        $password=$request->get('password');
        $user=DB::table('users')->where([['name', $name],['password',$password]])->first();
        
        if($user!=null)
        {   
            
            $s_id=session()->getId();
            $post=User::findOrFail($user->id);
            $post->session_id=$s_id;
            $post->save();
            
            $request->session()->put('is_login', true);
            $request->session()->put('user_name',$user->name);
            $request->session()->put('user_id',$user->id);
            $request->session()->put('point', $user->point);
            return redirect('/');
            
            
        }
        else{
            return redirect('/login');
            
            
        }
    }
    public function getLogout(Request $request){
            
            $request->session()->flush();
            $request->session()->put('is_login', false);
            return redirect('/');
    }
    
    
}
