<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
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
            'roles' => 'required|exists:roles,id', // Verifica que el rol seleccionado exista en la tabla 'roles'
            'estado' => 'required|in:1,0', // Verifica que el estado seleccionado sea 1 o 0
        ];
    }
    public function messages(): array
    {
        return [
            
            'roles.required' => 'Por favor selecciona un rol.',
            'roles.exists' => 'El rol seleccionado no es válido.',
            'estado.required' => 'Por favor selecciona un estado.',
            'estado.in' => 'El estado seleccionado no es válido.',
        ];
    }
}
