<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMarcas extends FormRequest
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
        $marcasId = $this->route('marcas');
        return [
            'nombre' => ['required','max:255', Rule::unique('marcas', 'nombre')->ignore($marcasId)],
            'pais' => 'required|exists:pais,id',
            'sitio' => 'nullable|url',
            'estado' => 'required|in:0,1', // Valores permitidos son 0 o 1
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Ajusta el tamaño máximo según tus necesidades
            'descripcion' => 'nullable|string',
        ];
    }
    
    public function messages()
    {
        return [
            'nombre.required' => 'El nombre de la marca es obligatorio.',
            'nombre.max' => 'El nombre de la marca no puede exceder los :max caracteres.',
            'nombre.unique' => 'Ya existe una marca con este nombre.',
            'pais.required' => 'El país es obligatorio.',
            'pais.exists' => 'El país seleccionado no es válido.',
            'sitio.url' => 'El sitio web debe ser una URL válida.',
            'estado.required' => 'El estado es obligatorio.',
            'estado.in' => 'El estado debe ser 0 o 1.',
            'logo.image' => 'El archivo debe ser una imagen.',
            'logo.mimes' => 'El archivo debe tener uno de los siguientes formatos: jpeg, png, jpg, gif.',
            'logo.max' => 'El tamaño máximo permitido para el logo es :max kilobytes.', // Ajusta el mensaje según tus necesidades
            'descripcion.string' => 'La descripción debe ser una cadena de texto.',
        ];
    }
}
