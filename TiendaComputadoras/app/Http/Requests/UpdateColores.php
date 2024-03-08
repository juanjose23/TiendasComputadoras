<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateColores extends FormRequest
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

        $colorId = $this->route('colores');
        return [
            'nombre' => [
                'required',
                Rule::unique('colores', 'nombre')->ignore($colorId),
                'regex:/^[a-zA-Z\s]+$/'
            ],
            'estado' => 'required|int',
            'codigo' => [
                'required',
                Rule::unique('colores', 'codigo')->ignore($colorId)
            ],
        ];
    }
    public function messages()
    {
        return [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.unique' => 'El nombre ya está en uso.',
            'estado.required' => 'El campo estado es obligatorio.',
            'estado.int' => 'Tiene que elegir un estado',
            'codigo.unique' => 'El nombre ya está en uso.',
            'codigo.required' => 'El campo nombre es obligatorio.'
        ];
    }
}
