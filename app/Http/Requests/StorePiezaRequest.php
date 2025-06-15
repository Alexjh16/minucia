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
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:1000',
            'precio' => 'required|numeric|min:0',
            'proveedor_id' => 'required|exists:proveedores,id',
            'cantidad' => 'required|integer|min:1',
            'codigo' => 'required|string|max:100|unique:piezas,codigo,' . $this->route('pieza'),
            'marca' => 'required|string|max:255',
            
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre de la pieza es obligatorio.',
            'descripcion.required' => 'La descripción de la pieza es obligatoria.',
            'precio.required' => 'El precio de la pieza es obligatorio.',
            'proveedor_id.required' => 'El proveedor de la pieza es obligatorio.',
            'cantidad.required' => 'La cantidad de la pieza es obligatoria.',
            'codigo.required' => 'El código de la pieza es obligatorio.',
            'marca.required' => 'La marca de la pieza es obligatoria.',
            'precio.numeric' => 'El precio debe ser un número valido.',
            'cantidad.integer' => 'La cantidad debe ser un número entero.',
            'codigo.unique' => 'El código de la pieza ya existe.',
            'proveedor_id.exists' => 'El proveedor seleccionado no es válido.',
        ];
    }
}
