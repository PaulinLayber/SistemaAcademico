<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
     public function rules(): array
    {
        return [
            'nome' => 'string|max:100',
            'email' => 'string|max:100|unique:usuarios,email',
            'password' => 'string|max:255|min:6',
            'role' => 'in:admin,professor,aluno',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.string' => 'O nome deve ser uma string.',
            'nome.max' => 'O nome não pode exceder 100 caracteres.',
            'email.string' => 'O email deve ser uma string.',
            'email.max' => 'O email não pode exceder 100 caracteres.',
            'email.unique' => 'Este email já está em uso.',
            'password.string' => 'A senha deve ser uma string.',
            'password.max' => 'A senha não pode exceder 255 caracteres.',
            'role.in' => 'O papel deve ser um dos seguintes: admin, professor, aluno.',
        ];
    }
}


