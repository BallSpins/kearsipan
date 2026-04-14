<?php

namespace App\Http\Requests\Letter;

use Illuminate\Foundation\Http\FormRequest;

class StoreIncomingRequest extends FormRequest
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
            'classification_code' => [
                'required',
                'exists:classifications,code',
            ],
            'origin_number' => [
                'required',
                'string',
                'max:255',
            ],
            'address' => [
                'required',
                'string',
            ],
            'subject' => [
                'required',
                'string',
            ],
            'file' => [
                'required', 
                'file', 
                'mimes:pdf', 
                'max:5120',
            ],
            'attachments' => [
                'nullable',
                'array',
            ],
            'attachments.*' => [
                'file', 
                'mimes:pdf,jpg,jpeg,png', 
                'max:2048',
            ],
        ];
    }
}
