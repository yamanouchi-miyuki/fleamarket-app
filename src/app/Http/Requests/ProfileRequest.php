<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'profile_image' => [
                'required',
                'file',
                'image',
                'mimes:jpeg,png'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'profile_image.required' => 'プロフィール画像を選択してください。',
            'profile_image.file' => 'ファイルを選択してください。',
            'profile_image.image' => '画像ファイルを選択してください。',
            'profile_image.mimes' => '画像の形式はjpegまたはpngにしてください。',
        ];
    }
}
