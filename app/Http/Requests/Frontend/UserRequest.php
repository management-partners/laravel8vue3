<?php

namespace App\Http\Requests\Frontend;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('edit', 'users');
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
            'password'  => 'required|min:6',
            'role_id'   => 'required',
        ];
    }
    //カスタムメッセージを設定
    public function messages()
    {
        return [
             'name.required'=>'名前は必ず入力して下さい。',
             'email.required'=>'メールは必ず入力して下さい。',
             'email.email'=>'メール式は確認して下さい。',
             'password.required'=>'パスワードは必ず入力して下さい。',
             'password.min'=>'パスワードは最低6入力して下さい。',
             'name.required'=>'roleは必ず入力して下さい。',
         ];
    }
}
