@extends('layout.layout')
@section('title', 'Asignaciones')
@section('submodulo', 'Lista de asignaciónes')
@section('content')
    <div class="card-header">
        <h5 class="card-title mb-0 text-black">Lista de cargos del colaborador {{$empleados->personas->nombre}}</h5>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th scope="col" class="px-4 py-3">
                        <span class="sr-only">#</span>
                    </th>
                    <th scope="col" class="px-4 py-3">Código</th>
                    <th scope="col" class="px-4 py-3">Cargos</th>
                    <th scope="col" class="px-4 py-3">Fecha de registro</th>
                    <th scope="col" class="px-4 py-3">Fecha de última actualizacion</th>
                    <th scope="col" class="px-4 py-3">Estado</th>
                 
                </tr>
            </thead>
            <tbody>
                @foreach ($asignacion as $colaborador)
                    <tr>
                        <td>{{ $loop->index }}</td>
                        <td>{{ $colaborador->cargos->codigo }}</td>
                        <td>{{ $colaborador->cargos->nombre }}</td>
                        <td>{{ $colaborador->created_at }}</td>
                        <td>{{ $colaborador->updated_at }}</td>
                        <td><span class="badge rounded-pill {{ $colaborador->estado == 1 ? 'bg-success' : 'bg-danger' }}">
                                {{ $colaborador->estado == 1 ? 'Activo' : 'Inactivo' }}
                            </span></td>
                     
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
