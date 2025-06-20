<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePiezaRequest extends FormRequest
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
            'peso_teorico' => 'required|decimal:1|min:0',
            'peso_real' => 'nullable|decimal:1|min:0',
            'estado' => 'required|string|max:255',
            'proyecto_id' => 'required|exists:proyectos,id',
            'bloque_id' => 'required|exists:bloques,id',
        ];
    }

    public function messages(): array
    {
        return [
            'pieza.required' => 'El nombre de la pieza es obligatorio.',
            'peso_teorico.required' => 'El peso teórico de la pieza es obligatorio.',
            'peso_real.required' => 'El peso real de la pieza es obligatorio.',
            'estado.required' => 'El estado de la pieza es obligatorio.',
            'bloque_id.required' => 'El bloque de la pieza es obligatorio.',
            'user_id.required' => 'El usuario de la pieza es obligatorio.',
            'pieza.string' => 'El nombre de la pieza debe ser una cadena de texto.',
            'peso_teorico.float' => 'El peso teórico de la pieza debe ser un número.',
            'peso_real.float' => 'El peso real de la pieza debe ser un número.',
            'estado.string' => 'El estado de la pieza debe ser una cadena de texto.',
            'bloque_id.exists' => 'El bloque seleccionado no es válido.',
            'user_id.exists' => 'El usuario seleccionado no es válido.',
            'codigo.unique' => 'El código de la pieza ya existe.',
            'peso_teorico.decimal' => 'El peso teórico debe ser un número decimal con un decimal.',
            'proyecto_id.required' => 'El proyecto de la pieza es obligatorio.',
            'proyecto_id.exists' => 'El proyecto seleccionado no es válido.',
        ];
    }
};
