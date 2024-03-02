<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSalarios extends FormRequest
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
            'empleados' => 'required|integer',
            'salario' => 'required|numeric|gt:0',
            'estado' => 'required|integer'
        ];
    }
    public function messages()
    {
        return [
            'empleados.required' => 'Tienes que seleccionar un colaborador',
            'empleados.integer' => 'Debes de seleccionar un colaborador',
            'salario.integer' => 'Debes ser solo valores númericos',
            'estado.integer'=>'Debes seleccionar un estado',
            'salario.gt'=>'Salario debe ser mayor que 0',

        ];
    }
}
