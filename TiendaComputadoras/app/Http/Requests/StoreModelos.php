<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreModelos extends FormRequest
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
            'nombre' => 'required|string|max:255|unique:marcas,nombre',
            'marca' => 'required|exists:marcas,id',
            'estado' => 'required|in:0,1', // Valores permitidos son 0 o 1
            'descripcion' => 'nullable|string',
        ];
    }
    
    public function messages()
    {
        return [
            'nombre.required' => 'El nombre de la modelo es obligatorio.',
            'nombre.string' => 'El nombre de la modelo debe ser una cadena de texto.',
            'nombre.max' => 'El nombre de la modelo no puede exceder los :max caracteres.',
            'nombre.unique' => 'Ya existe una modelo con este nombre.',
            'marca.required' => 'El marca es obligatorio.',
            'marca.exists' => 'El marca seleccionado no es válido.',
            'estado.required' => 'El estado es obligatorio.',
            'estado.in' => 'El estado debe ser 0 o 1.',
            'descripcion.string' => 'La descripción debe ser una cadena de texto.',
        ];
    }
}
