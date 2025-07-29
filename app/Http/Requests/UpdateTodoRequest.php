<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {//trueにするのはバリデーションしていい時
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [//更新するときのバリデーション
            'title' => 'required',
            'description' => 'nullable|string|max:500',
            'status' => 'required|in:未着手,進行中,完了',
        ];
    }
}
