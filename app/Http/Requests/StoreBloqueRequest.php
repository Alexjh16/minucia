<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBloqueRequest extends FormRequest
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
            'nombre' => 'required|string|max:100',
            'codigo' => 'required|string|max:100',
            'proyecto_id' => 'required|exists:proyectos,id',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del bloque es obligatorio.',
            'nombre.string' => 'El nombre del bloque debe ser una cadena de texto.',
            'nombre.max' => 'El nombre del bloque no puede exceder los 100 caracteres.',
            'codigo.string' => 'El código del bloque debe ser una cadena de texto.',
            'codigo.max' => 'El código del bloque no puede exceder los 100 caracteres.',
            'codigo.required' => 'El código del bloque es obligatorio.',
            'proyecto_id.required' => 'El proyecto asociado es obligatorio.',
            'proyecto_id.exists' => 'El proyecto seleccionado no existe.',
        ];
    }
}
