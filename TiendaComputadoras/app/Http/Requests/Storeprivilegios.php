<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Storeprivilegios extends FormRequest
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
    public function rules()
    {
        return [
            'rol' => 'required|exists:roles,id',
            'submodulos' => 'required',
            'submodulos.*' => 'required|exists:submodulos,id',
        ];
    }

    public function messages()
    {
        return [
            'rol.required' => 'El campo Rol es obligatorio.',
            'rol.exists' => 'El Rol seleccionado no es válido.',
            'submodulos.required' => 'Debe seleccionar al menos un submódulo.',
            'submodulos.*.required' => 'Todos los submódulos seleccionados son obligatorios.',
            'submodulos.*.exists' => 'Alguno de los submódulos seleccionados no es válido.',
        ];
    }
}
