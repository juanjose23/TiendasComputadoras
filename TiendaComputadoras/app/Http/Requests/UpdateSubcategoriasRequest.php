<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSubcategoriasRequest extends FormRequest
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

        $subcategoriaId = $this->route('subcategorias');
        return [
            'nombre' => [
                'required',
                Rule::unique('subcategorias', 'nombre')->ignore($subcategoriaId),
                'regex:/^[a-zA-Z\s]+$/'
            ],
            'categoria' => 'required|int',
            'estado' => 'required|int',
            'descripcion' => 'nullable|max:500',
        ];
    }
    public function messages()
    {
        return [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.unique' => 'El nombre ya está en uso.',
            'estado.required' => 'El campo estado es obligatorio.',
            'estado.int' => 'Tiene que elegir un estado',
            'categoria.required' => 'El campo categoria es obligatorio.',
            'categoria.int' => 'Tiene que elegir un categoria',
            'descripcion.max' => 'La descripción no debe contener más de :max caracteres.',
        ];
    }
}
