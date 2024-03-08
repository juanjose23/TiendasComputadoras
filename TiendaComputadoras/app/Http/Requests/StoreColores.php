<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreColores extends FormRequest
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
            //
            'nombre' => 'required|unique:colores,nombre| regex:/^[a-zA-Z\s]+$/',
            'estado' => 'required|int',
            'codigo' => 'required|unique:colores,codigo'
        ];
    }
    public function messages()
    {
        return [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.unique' => 'El nombre ya está en uso.',
            'estado.required' => 'El campo estado es obligatorio.',
            'estado.int'=>'Tiene que elegir un estado',
            'codigo.unique' => 'El nombre ya está en uso.',
            'codigo.required' => 'El campo nombre es obligatorio.'
        ];
    }
}
