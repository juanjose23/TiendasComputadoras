<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateModelos extends FormRequest
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
        $modeloId = $this->route('modelos');
        return [
            'nombre' => ['required','max:255', Rule::unique('modelos', 'nombre')->ignore($modeloId)],
            'marca' => 'required|exists:marcas,id',
            'estado' => 'required|in:0,1', // Valores permitidos son 0 o 1
            'descripcion' => 'nullable|string',
        ];
    }
    
    public function messages()
    {
        return [
            'nombre.required' => 'El nombre del modelo es obligatorio.',
            'nombre.max' => 'El nombre del  modelo no puede exceder los :max caracteres.',
            'nombre.unique' => 'Ya existe un modelo con este nombre.',
            'marca.required' => 'El marca es obligatorio.',
            'marca.exists' => 'El marca seleccionado no es válido.',
            'estado.required' => 'El estado es obligatorio.',
            'estado.in' => 'El estado debe ser 0 o 1.',
            'descripcion.string' => 'La descripción debe ser una cadena de texto.',
        ];
    }
}
