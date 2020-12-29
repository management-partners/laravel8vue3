<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInfoRequest extends FormRequest
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
            'name'      => 'required',
            'email'     => 'required|email',
        ];
    }
    //カスタムメッセージを設定
    public function messages()
    {
        return [
             'name.required'        =>'名前は必ず入力して下さい。',
             'email.required'       =>'メールは必ず入力して下さい。',
             'email.email'          =>'メール式は確認して下さい。',
             'password.required'    =>'パスワードは必ず入力して下さい。',
         ];
    }
}
