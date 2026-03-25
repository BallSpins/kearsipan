<?php

namespace App\Http\Requests\LetterRequest;

use Illuminate\Foundation\Http\FormRequest;

class ApproveLetterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'classification_code' => [
                'required', 
                'exists:classifications,code',
            ],
            'full_number' => [
                'required', 
                'string', 
                'unique:letters,full_number',
            ],
            'subject' => [
                'required', 
                'string', 
                'max:255',
            ],
            'address' => [
                'required', 
                'string', 
                'max:255',
            ],
            'description' => [
                'nullable', 
                'string',
            ],
        ];
    }
}
