<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name'=>'required|max:10|unique:users,name',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6|max:15|confirmed'
        ];
    }
    public function messages(){
        return[
            'name.required'=>'用户名不能为空',
            'name.max'=>'用户名长度不能大于10个字符',
            'name.unique'=>'该用户名已存在',
            'email.required'=>'邮箱不能为空',
            'email.unique'=>'该邮箱已存在',
            'email.email'=>'邮箱格式不正确',
            'password.required'=>'密码不能为空',
            'password.min'=>'密码不能小于6位字符',
            'password.max'=>'密码不能大于15位字符',
            'password.confirmed'=>'两次密码输入不同请重新输入'
        ];
    }
}
