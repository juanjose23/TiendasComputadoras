<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateRoles extends FormRequest
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
        $rolId = $this->route('roles'); // Obtén el ID del cargo de la ruta

        return [
            'nombre' => [
                'required',
                Rule::unique('roles', 'nombre')->ignore($rolId),
                'regex:/^[a-zA-Z\s]+$/'
            ],
         
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
            'estado.int' => 'Tiene que elegir un estado',
            'descripcion.max' => 'La descripción no debe contener más de :max caracteres.',
        ];
    }
}
