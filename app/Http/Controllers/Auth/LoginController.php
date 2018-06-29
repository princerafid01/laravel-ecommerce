<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Session;
use User;
use Illuminate\Support\Facades\Hash;

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
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function index()
    {
        return view('login');
    }

    public function SignIn(Request $request)
    {
        $this->validate($request,[
            'email' => 'email',
            'password' => 'min:6'
        ]);
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->intended(route('index'));
        }
        Session::flash('err', 'Your credentials didn\'t match!');
        return redirect()->back()->withInput($request->only('email'));        
    }

    public function register(Request $request)
    {
        $this->validate($request,[
            'name' => 'min:4',
            'email' => 'email|unique:users',
            'mobile_number' => 'numeric|min:11',
            'password' => 'min:6|confirmed'
        ]);
        $user = \App\User::create([
            'name' => trim($request->name),
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'password' => Hash::make($request->password),
        ]);
        $customer_id = $user->id;
        $customer_name= $user->name;
        if ($user) {
            if (Auth::guard('web')->attempt(['email' => $request->email,'password' => $request->password])) {
                return redirect()->intended(route('index'));                
            }          
        }
        return redirect()->back()->withInput($request->only('name','email'));        
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('index');
    }
}
