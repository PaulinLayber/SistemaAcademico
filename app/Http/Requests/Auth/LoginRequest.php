<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|string|email|max:100',
            'password' => 'required|string|max:255',
        ];
    }
    public function messages(): array
    {
        return [
            'email.required' => 'O campo de email é obrigatório.',
            'email.string' => 'O email deve ser uma string.',
            'email.email' => 'O email deve ser um endereço de email válido.',
            'email.max' => 'O email não pode exceder 100 caracteres.',
            'password.required' => 'O campo de senha é obrigatório.',
            'password.string' => 'A senha deve ser uma string.',
            'password.max' => 'A senha não pode exceder 255 caracteres.',
        ];
    }
}
