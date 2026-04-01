<?php

namespace App\Http\Requests\LetterRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreOutgoingRequest extends FormRequest
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
            'subject' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'required',
                'string',
            ],

            'draft_file' => [
                'nullable', 
                'file', 
                'mimes:pdf,doc,docx', 
                'max:5120'
            ], // Max 5MB

            // Validasi array lampiran pendukung
            'attachments' => [
                'nullable', 
                'array'
            ],
            'attachments.*' => [
                'file', 
                'mimes:pdf,jpg,jpeg,png', 
                'max:2048'
            ], // Max 2MB per file
        ];
    }

    public function messages()
    {
        return [
            'subject.required' => 'Perihal surat tidak boleh kosong.',
            'draft_file.mimes' => 'Draf surat harus berupa file PDF atau Word.',
            'draft_file.max' => 'Ukuran file maksimal adalah 5MB.',
            'attachments.*.max' => 'Ukuran lampiran maksimal adalah 2MB.',
        ];
    }
}
