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
            'weight' => 'required|numeric',
            'calories' => 'required|integer',
            'exercise_time' => 'required|date_format:H:i',
            'exercise_content' => 'nullable|string',
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
            'date.required' => '日付は必須です。',
            'date.date' => '日付の形式が正しくありません。',
            'weight.required' => '体重は必須です。',
            'weight.numeric' => '体重は数値で入力してください。',
            'calories.required' => 'カロリーは必須です。',
            'calories.integer' => 'カロリーは整数で入力してください。',
            'exercise_time.required' => '運動時間は必須です。',
            'exercise_time.date_format' => '運動時間の形式は H:i です。',
            'exercise_content.string' => '運動内容は文字列で入力してください。',
        ];
    }
}
