<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LinkRequest extends FormRequest
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
     */
    public function rules(): array
    {
        $rules = [
            'original_url' => ['required', 'url'],
            'short_url'    => ['nullable', 'string', 'min:3', 'max:50', 'unique:links,short_url'],
            'name'         => ['nullable', 'string', 'min:3', 'max:30'],
        ];

        // Ha update (PATCH / PUT), az original_url nem kötelező:
        if ($this->isMethod('patch') || $this->isMethod('put')) {
            $rules['original_url'] = ['nullable', 'url'];
        }

        return $rules;
    }
}
