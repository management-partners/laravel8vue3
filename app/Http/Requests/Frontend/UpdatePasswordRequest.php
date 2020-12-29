<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            'password'          => 'required|min:6',
            'password_confirm'  => 'require|same:password',
        ];
    }
    //カスタムメッセージを設定
    public function messages()
    {
        return [
             'password.required'        =>'パスワードは必ず入力して下さい。',
             'password.min'             =>'パスワードは最低6入力して下さい。',
             'password_confirm.required'=>'パスワード確認は必ず入力して下さい。',
             'password_confirm.same'    =>'パスワードはパスワード確認と違いますので、再確認して下さい。',
         ];
    }
}
