<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'price'     => 'required|numeric',
        ];
    }
    //カスタムメッセージを設定
    public function messages()
    {
        return [
              'name.required'=>'名前は必ず入力して下さい。',
              'price.required'=>'単価は必ず入力して下さい。',
              'price.numeric'=>'数字式は確認して下さい。',
          ];
    }
}
