<?php

namespace App\Http\Requests\LetterRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequestFile extends FormRequest
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
            'file' => [
                'required', 
                'file', 
                'mimes:pdf,doc,docx', 
                'max:5120' // Maksimal 5MB
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'Pilih file terlebih dahulu.',
            'file.mimes' => 'Draf surat harus berupa file PDF atau Word.',
            'file.max' => 'Ukuran file maksimal adalah 5MB.',
        ];
    }
}
