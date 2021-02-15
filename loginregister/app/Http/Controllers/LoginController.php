<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('loginpage');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        //dd($credentials);
        $auth = Auth::guard('admin');
        if ($auth->attempt($credentials)) {
            //return 'success';
            return view('dashboard');
        }
        // return 'error';
        return redirect()->route('login')->with('alert-info', 'Login Fail, please check email or password');
    }

    public function logout()
    {
        Auth()->guard('admin')->logout();
        return view('loginpage');
    }
}
