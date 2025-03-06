<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'email' => ['required', 'email'],
            'phone1' => ['required', 'regex:/^\d{1,5}$/'],
            'phone2' => ['required', 'regex:/^\d{1,5}$/'],
            'phone3' => ['required', 'regex:/^\d{1,5}$/'],
            'address' => ['required'],
            'inquiry_type' => ['required'],
            'detail' => ['required', 'max:120'],
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' =>'性を入力してください',
            'last_name.required' => '名を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'phone1.required' => '電話番号を入力してください',
            'phone1.regex' => '電話番号は5桁までの数字で入力してください',
            'phone2.required' => '電話番号を入力してください',
            'phone2.regex' => '電話番号は5桁までの数字で入力してください',
            'phone3.required' => '電話番号を入力してください',
            'phone3.regex' => '電話番号は5桁までの数字で入力してください',
            'address.required' => '住所を入力してください',
            'inquiry_type.required' => 'お問い合わせの種類を選択してください',
            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.max' => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }
}
