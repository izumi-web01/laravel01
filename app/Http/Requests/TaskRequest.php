<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class TaskRequest extends FormRequest
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
        $rules =  [
            //
            'task_name' => 'required|string| min:1 | max:5',
        ];
        if ($this->status !== null) {
            // 完了の時は対象外にする
            // status が 0（nullでない） の場合は task_name のバリデーションをスキップ
            unset($rules['task_name']);
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'task_name.required' => 'タスク名を必ず入力してください',
            'task_name.string' => '文字列で入力してください',
            'task_name.min' => '1文字以上で入力してください',
            'task_name.max' => '5文字以下で入力してください',
        ];
    }
}
