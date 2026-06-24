<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'task' => 'required|min:5|max:255',
        ];
    }

    /**
     * Get the validation messages.
     * 
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'task.required' => 'Task wajib diisi',
            'task.min' => 'Task minimal 5 karakter',
            'task.max' => 'Task maksimal 255 karakter',
        ];
    }
}
