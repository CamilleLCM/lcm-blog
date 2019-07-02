<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'mobile'=>['required','exists:users,mobile','regex:/^1(3|4|5|7|8)\d{9}$/'],
            'password'=>'required|min:6|max:15'
        ];
    }
    public function messages(){
        return[
            'mobile.required'=>'手机号不能为空',
            'mobile.exists'=>'该手机号未注册请先注册后再登录',
            'mobile.regex'=>'手机号格式不正确',
            'password.required'=>'密码不能为空',
            'password.min'=>'密码不能小于6位字符',
            'password.max'=>'密码不能大于15位字符',
        ];
    }
}
