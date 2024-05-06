<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProveedores extends FormRequest
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
            'nombre'=>'required |regex:/^[a-zA-Z\s]+$/',
            'apellido'=>'required |regex:/^[a-zA-Z\s]+$/',
            'telefono' => 'required|unique:personas,telefono',
            'celular' => 'required|unique:proveedores,telefono',
            'pais' => 'integer',
            'estado'=>'integer',
            'correo' => 'nullable|email|unique:personas,correo',
            'tipo' => 'required',
            'sector' => 'required',
            'identificacion' => [
                'regex:/^\d{3}-\d{6}-\d{4}[a-zA-Z]$/',
                'required',
                Rule::unique('persona_naturales')->where(function ($query) {
                    return $query->whereNotExists(function ($subquery) {
                        $subquery->select('id')
                            ->from('persona_juridicas')
                            ->whereRaw('persona_juridicas.ruc = persona_naturales.identificacion');
                    });
                })
            ],
            'fecha' => ['before:' . Carbon::now()->subYears(18)->format('Y-m-d')],
            'direccion' => 'required',
            'descripcion' => 'nullable|string',
            'foto' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'departamentos' => 'required|exists:municipios,id'
        ];
    }
}
