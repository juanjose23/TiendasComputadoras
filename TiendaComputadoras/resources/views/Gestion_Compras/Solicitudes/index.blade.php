@extends('layout.layouts')
@section('title', 'Solicitudes')
@section('submodulo', 'Solicitudes de compras')
@section('content')
    <div class="row">
        <section class="col-md-12 col-xl-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Solicitudes de compras</h5>
                </div>
                <div class="card-body text-center">
                    <livewire:solicitudes />
                </div>
            </div>
        </section>
    </div>
@endsection
