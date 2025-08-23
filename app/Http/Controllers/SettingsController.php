<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(){
        return view('userPages.userSettings');
    }

    public function update(Request $request){
        try{
           $request->validate([
                'username' => 'required',
                'user_email' => 'required',
                'phone_number' => 'required',
                'password' => 'required|min:6|alpha_num',
                'password_confirmation' => 'required|same:password'
            ]);

            $user = User::find($request->user_id);

            $user->update([
                'name' => $request->username,
                'email' => $request->user_email,
                'phone' => $request->phone_number,
                'password' => $request->password,          
            ]);
            session()->flash('success','Profile Updated');
            return back();

        }catch(\Exception $e){
            session()->flash('error','Could not update Profile');
            return back();
        }

    }
}
