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
            'email'=>'required|email',
            'password'=>'required|min:6|max:15'
        ];
    }
    public function messages(){
        return[
            'email.required'=>'邮箱不能为空',
            'email.email'=>'邮箱格式不正确',
            'password.required'=>'密码不能为空',
            'password.min'=>'密码不能小于6位字符',
            'password.max'=>'密码不能大于15位字符',
        ];
    }
}
