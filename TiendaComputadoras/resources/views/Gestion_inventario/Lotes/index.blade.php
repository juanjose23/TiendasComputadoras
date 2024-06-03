@extends('layout.layouts')
@section('title', 'Lotes')
@section('submodulo', 'Acerca del Lotes')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0 text-black">Lotes de Productos</h5>
            </div>
            <div class="card-body">

                <livewire:lote/>


            </div>
        </div>
    </div>
</div>
@endsection
