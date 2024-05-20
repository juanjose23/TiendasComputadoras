<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Updateproveedor extends FormRequest
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
        $proveedores = $this->route('proveedores');
        return [
            'nombre'=>'required |regex:/^[a-zA-Z\s]+$/',
            'apellido'=>'required |regex:/^[a-zA-Z\s]+$/',
            'telefono' =>['required', Rule::unique('personas')->ignore($proveedores->personas_id)] ,
            'pais' => 'integer',
            'celular' =>['nullable', Rule::unique('proveedores')->ignore($proveedores)] ,
            'estado'=>'integer',
            'correo' => ['nullable','required', Rule::unique('personas')->ignore($proveedores->personas_id)],
            'tipo' => 'required',
            'identificacion' => [
                'regex:/^\d{3}-\d{6}-\d{4}[a-zA-Z]$/',
                'required',
                Rule::unique('persona_naturales')
                    ->ignore($proveedores->personas_id)
                    ->where(function ($query) {
                        $query->whereNotExists(function ($subquery) {
                            $subquery->select('id')
                                ->from('persona_juridicas')
                                ->whereRaw('persona_juridicas.ruc = persona_naturales.identificacion');
                        });
                    })
            ],
            'fecha' => ['before:' . Carbon::now()->subYears(18)->format('Y-m-d')],
            'direccion' => 'required',
            'foto' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'departamentos' => 'required|exists:municipios,id'
        ];
    }
    public function messages()
{
    return [
        'nombre.required' => 'El nombre es obligatorio.',
        'nombre.regex' => 'El nombre solo puede contener letras y espacios.',
        'apellido.required' => 'El apellido es obligatorio.',
        'apellido.regex' => 'El apellido solo puede contener letras y espacios.',
        'telefono.required' => 'El teléfono es obligatorio.',
        'telefono.unique' => 'El teléfono ya está registrado.',
        'pais.integer' => 'El país debe ser un número entero.',
        'celular.unique' => 'El celular ya está registrado.',
        'estado.integer' => 'El estado debe ser un número entero.',
        'correo.required' => 'El correo es obligatorio.',
        'correo.unique' => 'El correo ya está registrado.',
        'tipo.required' => 'El tipo es obligatorio.',
        'identificacion.required' => 'La identificación es obligatoria.',
        'identificacion.regex' => 'La identificación debe tener el formato 000-000000-0000A.',
        'identificacion.unique' => 'La identificación ya está registrada.',
        'fecha.before' => 'La fecha debe ser anterior a :date.',
        'direccion.required' => 'La dirección es obligatoria.',
        'foto.image' => 'La foto debe ser una imagen.',
        'foto.mimes' => 'La foto debe ser un archivo de tipo: jpeg, png, jpg, gif.',
        'foto.max' => 'La foto no debe ser mayor de 2048 kilobytes.',
        'departamentos.required' => 'El departamento es obligatorio.',
        'departamentos.exists' => 'El departamento seleccionado no existe.',
    ];
}

}
