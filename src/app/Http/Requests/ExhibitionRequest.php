<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'image' => ['required', 'file', 'mimes:jpeg,png'],
            'category_ids' => ['required', 'array'],
            'category_ids.*' => ['integer', 'exists:categories,id'],
            'condition'    => ['required', 'string'],
            'brand_name'   => ['nullable', 'string'],
            'price'        => ['required', 'numeric', 'min:0'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '入力必須項目です',
            'description.required' => '入力必須項目です',
            'description.max' => '255字以内で入力してください',
            'image.required' => 'アップロード必須です',
            'image.mimes' => '拡張子は.jpegもしくは.pngでお願いします',
            'category_ids.required' => '選択必須項目です',
            'condition.required' => '選択必須項目です',
            'price.required' => '入力必須項目です',
            'price.numeric' => '数値でお願いします',
            'price.min' => '0円以上でお願いします',
    ];
    }
}
