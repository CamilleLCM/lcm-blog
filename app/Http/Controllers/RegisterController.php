<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Validator;
use Illuminate\Http\Request;
use Toplan\Sms\SmsManager;


class RegisterController extends Controller
{
    //用户注册页面
    public function index()
    {
        return view('register.index');
    }

    //用户注册逻辑
    public function register(Request $request)
    {
//        $user = User::Create([
//            'name'=>$request->name,
//            'email'=>$request->email,
//            'password'=>bcrypt($request->password),
//        ]);
//        if($user){
//            return redirect('user/login');
//        }else{
//            return \Redirect::back()->withErrors("注册失败请重试");
//        }


        $result = \SmsManager::validateSendable();
        if ($result) {
//            验证数据
            $validator = Validator::make($request->only('mobile', 'verifyCode'), [
                'mobile' => 'required|confirm_mobile_not_change|confirm_rule:mobile_required',
                'verifyCode' => 'required|verify_code',
                //more...
            ]);
            if ($validator->fails()) {
                //验证失败后建议清空存储的发送状态，防止用户重复试错
                \SmsManager::forgetState();
                return redirect()->back()->withErrors($validator);
            }
            $user = User::Create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'mobile'=>$request->mobile,
            'code'=>$request->verifyCode
        ]);
        if($user){
            return redirect('user/login');
        }else{
            return \Redirect::back()->withErrors("注册失败请重试");
        }
        }


    }
}
