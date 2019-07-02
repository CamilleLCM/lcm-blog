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
    public function register(RegisterRequest $request)
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

        //校验是否可进行发送，排除短信条数不足等情况。
        //可进行发送返回结果集
    /*
     * array([
     *      "success"=>bool(true),
     *       "type"=> "can_send",
     *      "message"=>"can_send"
     *  ]);
     *
     */
        $result = \SmsManager::validateSendable();
        if ($result) {
           //验证数据
            $validator = Validator::make($request->only('mobile', 'verifyCode'), [
              //验证规则
                'mobile' => 'confirm_mobile_not_change|confirm_rule:mobile_required',
                'verifyCode' => 'required|verify_code',
                //more...
            ],
            [
                //自定义错误消息
            'mobile.required'=>"手机号不能为空",
            'mobile.confirm_mobile_not_change'=>"手机号已变更,请重新发送验证码",
            'mobile.confirm_rule'=>"手机号不能为空",
            'verifyCode.required'=>"验证码不能为空",
            'verifyCode.verify_code'=>"验证码错误",
            ]);
            //如果不匹配输出错误
            if ($validator->fails()) {
                //验证失败后建议清空存储的发送状态，防止用户重复试错
                \SmsManager::forgetState();
                return redirect()->back()->withErrors($validator);
            }
            //如果匹配，你的逻辑
            $user = User::Create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'mobile' => $request->mobile,
            ]);
            if ($user) {
                echo "注册成功";
                return redirect('user/login');
            } else {
                return \Redirect::back()->withErrors("注册失败请重试");
            }
        }


    }
}
