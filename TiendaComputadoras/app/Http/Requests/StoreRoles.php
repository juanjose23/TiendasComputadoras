<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoles extends FormRequest
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
            'nombre' => 'required|unique:roles,nombre| regex:/^[a-zA-Z\s]+$/',
            'estado' => 'required|int',
            'descripcion' => 'nullable|max:300',
        ];
    }
    public function messages()
    {
        return [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.unique' => 'El nombre ya está en uso.',
         
            'estado.required' => 'El campo estado es obligatorio.',
            'estado.int'=>'Tiene que elegir un estado',
            'descripcion.max' => 'La descripción no debe contener más de :max caracteres.',
        ];
    }
}
