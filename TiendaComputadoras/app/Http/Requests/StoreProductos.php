<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductos extends FormRequest
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
            'nombre' => [
                'required',
                Rule::unique('productos')->where(function ($query) {
                    return $query->where('nombre', $this->input('nombre'))
                        ->where('subcategorias_id', $this->input('subcategoria'))
                        ->where('modelos_id', $this->input('modelo'))
                        ->whereIn('id', function ($query) {
                            $query->select('productos_id')
                                ->from('colores_productos')
                                ->where('colores_id', $this->input('color'));
                        });
                })->ignore($this->route('producto')), // Ignora el producto actual al validar la unicidad del nombre
            ],
            'dimensiones' => 'required',
            'peso' => 'required',
            'estado' => 'required|integer',
            'fecha' => 'required|date_format:Y-m-d',
            'material' => 'nullable|string',
            'instrucciones_cuidado' => 'nullable|string',
            'caracteristicas_especiales' => 'nullable|string',
            'compatibilidad' => 'nullable|string',
            'descripcion' => 'nullable|string',
        ];
    }
    
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'nombre.unique' => 'Ya existe un producto con el mismo nombre, subcategoría, modelo y color.',
            'dimensiones.required' => 'Las dimensiones del producto son obligatorias.',
            'peso.required' => 'El peso del producto es obligatorio.',
            'estado.required' => 'El estado del producto es obligatorio.',
            'estado.integer' => 'El estado del producto debe ser un número entero.',
            'fecha.required' => 'La fecha de lanzamiento del producto es obligatoria.',
            'material.string' => 'El material debe ser una cadena de texto.',
            'instrucciones_cuidado.string' => 'Las instrucciones de cuidado deben ser una cadena de texto.',
            'caracteristicas_especiales.string' => 'Las características especiales deben ser una cadena de texto.',
            'compatibilidad.string' => 'La compatibilidad debe ser una cadena de texto.',
            'descripcion.string' => 'La descripción debe ser una cadena de texto.',
        ];
    }
    
}
