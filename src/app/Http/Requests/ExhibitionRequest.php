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
            'name' => ['required', 'string'],
            'description' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpeg,png'],
            'category_id' => ['required', 'exists:categories,id'],
            'condition' => ['required'],
            'price' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '商品名を入力してください。',
            'description.required' => '商品説明を入力してください。',
            'description.max' => '商品説明は255文字以内で入力してください。',
            'image.required' => '商品画像をアップロードしてください。',
            'image.image' => '画像ファイルをアップロードしてください。',
            'image.mimes' => '商品画像は「.jpeg」または「.png」のみ対応しています。',
            'category_id.required' => '商品のカテゴリーを選択してください。',
            'category_id.exists' => '選択されたカテゴリーは存在しません。',
            'condition.required' => '商品の状態を選択してください。',
            'price.required' => '商品価格を入力してください。',
            'price.numeric' => '商品価格は数値で入力してください。',
            'price.min' => '商品価格は0円以上にしてください。',
        ];
    }
}
