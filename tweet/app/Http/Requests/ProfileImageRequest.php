<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileImageRequest extends FormRequest
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
            'file' => 'required|file|image|mimes:jpeg,png'
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'ファイルを選択して下さい',
            'file.image' => '画像ファイルを選択して下さい',
            'file.mines' => '画像ファイルはjpegかpngのものを選択して下さい'
        ];
    }
}
