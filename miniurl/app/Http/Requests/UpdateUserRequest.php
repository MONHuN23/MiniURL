<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'min:6', Rule::unique('users', 'email')->ignore($this->user())],
            'password' => 'nullable|min:6',
            'name' => 'required',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ];
    }
}
