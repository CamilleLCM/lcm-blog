<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\Users;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //用户注册页面
    public function index(){
        return view('register.index');
    }
    //用户注册逻辑
    public function register(RegisterRequest $request){
        $user = Users::Create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);
        if($user){
            return redirect('user/login');
        }else{
            return "注册失败，请重试";
        }
    }
}
