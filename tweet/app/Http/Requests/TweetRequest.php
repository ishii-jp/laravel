<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TweetRequest extends FormRequest
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
            'image.*' => 'file|image|mimes:jpeg,png',
            'text' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'image.*.image' => '画像ファイルを選択して下さい',
            'image.*.mines' => '画像ファイルはjpegかpngのものを選択して下さい',
            'text.required' => 'ツイート本文が未入力です。'
        ];
    }
}
