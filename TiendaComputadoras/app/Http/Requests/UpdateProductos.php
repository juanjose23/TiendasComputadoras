<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateProductos extends FormRequest
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
        $productoId = $this->route('productos');
        return [
            'nombre' => [
                'required',
                Rule::unique('productos')->where(function ($query) {
                    return $query->where('nombre', $this->input('nombre'))
                    ->where('subcategorias_id', $this->input('subcategoria'))
                    ->where('modelos_id', $this->input('modelo'))
                    ->whereIn('id', function ($query) {
                        $query->select('productos_id')
                            ->from('detallesproductos')
                            ->where('colores_id', $this->input('color'));
                    })
                    ->whereIn('id', function ($query) {
                        $query->select('productos_id')
                            ->from('detallesproductos')
                            ->where('tallas_id', $this->input('talla'));
                    })
                    ->whereIn('id', function ($query) {
                        $query->select('productos_id')
                            ->from('detallesproductos')
                            ->where('generos_id', $this->input('generos'));
                    })
                    ->whereIn('id', function ($query) {
                        $query->select('productos_id')
                            ->from('detallesproductos')
                            ->where('cortes_id', $this->input('corte'));
                    });
                })->ignore($productoId), 
            ],
            'estado' => 'required|integer',
            'fecha' => 'required|date_format:Y-m-d',
            'descripcion' => 'nullable|string',
            'talla'=> 'required',
            'corte'=> 'required',
            'generos'=> 'required',
        ];
    }
    
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'nombre.unique' => 'Ya existe un producto con el mismo nombre, subcategoría, modelo y color.',
          
            'estado.required' => 'El estado del producto es obligatorio.',
            'estado.integer' => 'El estado del producto debe ser un número entero.',
            'fecha.required' => 'La fecha de lanzamiento del producto es obligatoria.',
            'descripcion.string' => 'La descripción debe ser una cadena de texto.',
        ];
    }
}
