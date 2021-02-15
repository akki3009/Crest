<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class RegisterController extends Controller
{
     public function index()
    {
        return view('registerpage');
    }
    public function userRegister(Request $request)
    {
        $request->validate([
            'name'=>'required|max:25',
            'email'=>'required|email|max:255|unique:users',
            'password'=>'required',
        ]);
        if ($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            $register = new User;
            // dd($register);
            $register->name = $data['name'];
            $register->email = $data['email'];
            $register->password = bcrypt($data['password']);
            $register->save();
            return view('loginpage');
        }
    }
}
