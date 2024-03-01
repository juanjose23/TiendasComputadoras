<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAsignacion extends FormRequest
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
            'empleados'=>'required|integer',
            'cargos'=>'required|integer',
            'estado'=>'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'empleados.integer'=>"Tienes que seleccionar un emplead@",
            'cargos.integer'=>'Tienes que seleccionar un cargo',
            'estado.integer'=>'Tienes que seleccionar un estado',
        ];
    }
}
