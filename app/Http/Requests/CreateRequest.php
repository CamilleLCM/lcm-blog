<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'title'=>['required','max:15','string'],
            'contents'=>['required','max:1500'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '标题不能为空',
            'title.max' => '标题最大长度为15个字符',
            'contents.required' => '文章内容不能为空',
            'contents.max' => '文章内容最长1500个字',
        ];
    }

}
