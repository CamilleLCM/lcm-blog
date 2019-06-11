<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'content'=>'max:100|min:1'
        ];
    }

    public function messages(){
        return[
            'content.max'=>'评论最长不得超过100个字符',
            'content.min'=>'评论至少输入一个字符'
        ];
    }
}
