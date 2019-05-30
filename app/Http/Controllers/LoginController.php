<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //用户登录页面
    public function index(){
        return view('login.index');
    }
    //用户登录逻辑
    public function login(){

    }
    //用户登出逻辑
    public function logout(){

    }
}
