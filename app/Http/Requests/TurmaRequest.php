<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TurmaRequest extends FormRequest
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
    // app/Http/Requests/TurmaRequest.php

    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'professor_id' => 'required|exists:usuarios,id_usuario', 
            'disciplina_id' => 'required|exists:disciplinas,id_disciplina',
        ];
    }
    public function messages(): array{
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => 'O campo nome deve ser uma string.',
            'nome.max' => 'O campo nome não pode exceder 255 caracteres.',
            'descricao.string' => 'O campo descrição deve ser uma string.',
            'professor_id.required' => 'O campo professor é obrigatório.',
            'professor_id.exists' => 'O professor selecionado é inválido.',
            'disciplina_id.required' => 'O campo disciplina é obrigatório.',
            'disciplina_id.exists' => 'A disciplina selecionada é inválida.',
        ];
    }
}
