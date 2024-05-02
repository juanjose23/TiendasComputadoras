<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePrecios extends FormRequest
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
            'producto' => 'required|exists:detallesproductos,id',
            'precio' => 'required|numeric|min:0.01',
            'estado' => 'required|in:0,1',
        ];
    }
    
    public function messages()
    {
        return [
            'producto.required' => 'El campo Producto es obligatorio.',
            'producto.exists' => 'El producto seleccionado no es válido.',
            'precio.required' => 'El campo Precio es obligatorio.',
            'precio.numeric' => 'El campo Precio debe ser un número.',
            'precio.min' => 'El campo Precio debe ser mayor que cero.',
            'estado.required' => 'El campo Estado es obligatorio.',
            'estado.in' => 'El valor del campo Estado no es válido.',
        ];
    }
}
