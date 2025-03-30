<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWeightLogRequest extends FormRequest
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
            'date' => 'required|date',
            'weight' => 'required|string|regex:/^\d{1,4}(\.\d{1})?$/', // 4桁までの数字、小数点1桁まで
            'calories' => 'required|integer',
            'exercise_time' => 'required|date_format:H:i',
            'exercise_content' => 'nullable|string|max:120', // 最大120文字
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'date.required' => '日付を入力してください。',
            'date.date' => '日付の形式が正しくありません。',
            'weight.required' => '体重を入力してください。',
            'weight.numeric' => '数字で入力してください。',
            'weight.regex' => '4桁までの数字で、小数点は1桁まで入力してください。',
            'calories.required' => '摂取カロリーを入力してください。',
            'calories.integer' => '数字で入力してください。',
            'exercise_time.required' => '運動時間を入力してください。',
            'exercise_content.max' => '120文字以内で入力してください。',
        ];
    }
}
