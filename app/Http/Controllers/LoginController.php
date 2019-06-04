<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    //用户登录页面
    public function index(){
        return view('login.index');
    }
    //用户登录逻辑
    public function login(LoginRequest $request){
        $user = $request->only('email','password');
        $is_remember = boolval($request->input('is_remember')) ;
        if(\Auth::attempt($user,$is_remember)){
            return redirect('/posts');
        }else{
            return \Redirect::back()->withErrors('邮箱或密码错误');
        }
    }
    //用户登出逻辑
    public function logout(){
        \Auth::logout();
        return redirect('/user/login');
    }
}
