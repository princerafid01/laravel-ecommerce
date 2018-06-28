<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;

class AdminLoginController extends Controller
{
	public function __construct()
	{
		$this->middleware('guest:admin');
	}
    public function ShowLoginForm()
    {
    	return view('auth.admin-login');
    }

    public function login(Request $request)
    {
    	$this->validate($request,[
    		'email' => 'required|email',
    		'password' => 'required|min:6',
    	]);

    	$credentials = [
    		'email' => $request->email,
    		'password' => $request->password,
    	];

    	if(Auth::guard('admin')->attempt($credentials,$request->remember)){
    		return redirect()->intended(route('admin.dashboard'));
    	}
   		Session::flash('err','Your credentials didn\'t match!');
    	return redirect()->back()->withInput($request->only('email','remember'));    	
    }
}
