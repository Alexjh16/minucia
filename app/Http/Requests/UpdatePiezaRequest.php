<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePiezaRequest extends FormRequest
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
            'pieza' => 'required|string|max:255',
            'proyecto_id' => 'required|exists:proyectos,id',
            'bloque_id' => 'required|exists:bloques,id',
            'peso_teorico' => 'required|numeric',
            'peso_real' => 'required|numeric',

        ];
    }

    public function messages()
    {
        return [
            'pieza.required' => 'El nombre de la pieza es obligatorio.',
            'proyecto_id.required' => 'El proyecto de la pieza es obligatorio.',
            'bloque_id.required' => 'El bloque de la pieza es obligatorio.',
            'peso_teorico.numeric' => 'El peso teórico debe ser un número válido.',
            'peso_real.numeric' => 'El peso real debe ser un número válido.',
        ];
    }
}
