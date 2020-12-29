<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'first_name'    => 'required',
            'last_name'     => 'required',
            'email'         => 'required|email',
            'address'       => 'required',
            'mobile'        => 'required',
        ];
    }
    //カスタムメッセージを設定
    public function messages()
    {
        return [
              'first_name.required' =>'姓は必ず入力して下さい。',
              'last_name.required'  =>'名は必ず入力して下さい。',
              'email.required'      =>'メールは必ず入力して下さい。。',
              'email.email'         =>'メール式は確認して下さい。',
              'address.required'    =>'住所は必ず入力して下さい。',
              'mobile.required'     =>'携帯電話番号は確認して下さい。',
          ];
    }
}
