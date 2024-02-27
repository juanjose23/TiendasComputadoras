<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Models\Personas;
class UpdateColaborador extends FormRequest
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
        $colaboradores = $this->route('colaboradores');
        return [
            'nombre'=>'required |regex:/^[a-zA-Z\s]+$/',
            'apellido'=>'required |regex:/^[a-zA-Z\s]+$/',
            'telefono' =>['required', Rule::unique('personas')->ignore($colaboradores->personas_id)] ,
            'genero' => 'integer',
            'pais' => 'integer',
            'estado_civil'=>'integer',
            'estado'=>'integer',
            'correo' => ['nullable','required', Rule::unique('personas')->ignore($colaboradores->personas_id)],
            'tipo' => 'required',
            'identificacion' => ['regex:/^\d{3}-\d{6}-\d{4}[a-zA-Z]$/','required', Rule::unique('persona_naturales')->ignore($colaboradores->personas_id)],
            'fecha' => ['before:' . Carbon::now()->subYears(18)->format('Y-m-d')],
            'direccion' => 'required',
            'foto' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'departamentos' => 'required|exists:municipios,id'
        ];
    }
    public function messages()
    {
        return [
            'apellido.required' => 'El apellido es obligatorio.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.unique' => 'El teléfono ya está registrado.',
            'genero.integer' => 'El género es obligatorio.',
            'estado_civil.integer'=> 'El estado civil es obligatorio.',
            'estado.integer'=> 'El estado es obligatorio.',
            'pais.integer' => 'La nacionalidad es obligatoria.',
            'correo.email' => 'El formato del correo electrónico es inválido.',
            'correo.unique' => 'El correo electrónico ya está registrado.',
            'tipo.required' => 'El tipo de identificación es obligatorio.',
            'identificacion.regex' => 'El formato de la identificación es inválido.',
            'fecha.before' => 'Debes ser mayor de 18 años para registrarte.',
            'direccion.required' => 'La dirección es obligatoria.'
        ];
    }
}
