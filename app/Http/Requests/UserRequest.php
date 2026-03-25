<?php

namespace App\Http\Requests;

use App\Enums\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
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
        $isUpdate = $this->isMethod('put') || $this->isMethod('patch');
        
        return [
            'name' => ['required', 'string', 'max:255'],
            'username' => [
                'required', 
                'string', 
                'max:50', 
                'unique:users,username,' . ($this->user ? $this->user->id : 'NULL')
            ],
            'role' => ['required', new Enum(UserRole::class)],

            // Logic Conditional untuk Password
            'password' => [
                $isUpdate ? 'nullable' : 'required', // Jika update boleh null, jika create wajib ada
                'confirmed',
                Password::min(8),
            ],
        ];
    }
}
