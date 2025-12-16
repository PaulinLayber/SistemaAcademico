<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotaRequest extends FormRequest
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
        'aluno_id' => 'required|exists:usuarios,id_usuario,role,aluno',
        'turma_id' => 'required|exists:turmas,id_turma',
        'valor' => 'required|numeric|min:0|max:10|regex:/^\d+(\.\d{1,2})?$/',
    ];
}
    public function messages(): array
    {
        return [
            'aluno_id.required' => 'O campo aluno é obrigatório.',
            'aluno_id.exists' => 'O aluno selecionado não existe.',
            'turma_id.required' => 'O campo turma é obrigatório.',
            'turma_id.exists' => 'A turma selecionada não existe.',
            'valor.required' => 'O campo valor é obrigatório.',
            'valor.numeric' => 'O campo valor deve ser um número.',
            'valor.min' => 'O valor mínimo permitido é 0.',
            'valor.max' => 'O valor máximo permitido é 10.',
        ];
    }
}
