<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //用户设置界面
    public function setting(){
        return view('user.setting');
    }
    //用户设置逻辑
    public function settingStore(){

    }
}
