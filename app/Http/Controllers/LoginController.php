<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('loginPage');
    }

    public function login(Request $request){
        if(Auth::attempt(['name'=> $request->usernameOrEmail, 'password'=>$request->password])||
        Auth::attempt(['email'=> $request->usernameOrEmail, 'password'=>$request->password]))
        {
            if(Auth::user()->role == 'User'){
            return redirect()->route('userDashboard');
            }else{
                return redirect()->route('adminDashboard');
            }
        }
        return back()->with('error','Invalid Credentials!');
    }

    public function logout(){
        session()->invalidate();
        session()->regenerateToken();
        Auth::logout();
       return redirect()->route('home');
    }
}
