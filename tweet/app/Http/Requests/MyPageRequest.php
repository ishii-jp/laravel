<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MyPageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return false;
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
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'パスワードを入力して下さい',
            'password.confirmed' => '新しいパスワードが間違っています',
            'password_confirmation.required' => '新しいパスワード(確認用)を入力して下さい'
        ];
    }
}
