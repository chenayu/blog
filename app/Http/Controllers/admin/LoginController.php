<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;

class LoginController extends Controller
{
    public function login()
    {
        return view('admin.login.login');
    }

    public function dologin(Request $req)
    {
        $user = User::where('username','=',$req->username)->first(); 
      
        if($user){
            if(Hash::check($req->password,$user->password)){
                session([
                    'id'=>$user->id, 
                    'username'=>$user->username,
                ]);
                return redirect()->route('admin.index');
            }
            return back()->withInput()->withErrors('密码不正确');
        }else{
            return back()->withInput()->withErrors('帐号不正确');
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    
    }
}
