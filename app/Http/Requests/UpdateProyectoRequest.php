<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProyectoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'codigo' => 'required|string|max:10',
            'nombre' => 'required|string|max:100',
        ];
    }

    public function messages()
    {
        return [
            'codigo.required' => 'El código del proyecto es obligatorio.',
            'nombre.required' => 'El nombre del proyecto es obligatorio.',
            'codigo.max' => 'El código del proyecto no puede exceder los 10 caracteres.',
            'nombre.max' => 'El nombre del proyecto no puede exceder los 100 caracteres.',
            'codigo.string' => 'El código del proyecto debe ser una cadena de texto.',
            'nombre.string' => 'El nombre del proyecto debe ser una cadena de texto.',
            'codigo.unique' => 'El código del proyecto ya existe.',
            'nombre.unique' => 'El nombre del proyecto ya existe.',
        ];
    }
}
