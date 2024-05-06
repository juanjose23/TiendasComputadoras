@extends('layout.layouts')
@section('title', 'Inicio')
@section('submodulo', 'Inicio')

@section('content')
    <div class="row">
        <section class="col-md-12 col-xl-12">
            <div class="card mb-12">

                <div class="card-body text-center">


                        <img src="{{ session('Foto') }}" alt="{{ session('nombre') }}" class="img-fluid rounded-circle mb-2"
                            width="100" height="128" />
               

                    <h5 class="card-title mb-0">
                       Bienvenido  {{ session('nombre') }}

                    </h5>
                    <div class="text-muted mb-2"></div>

                </div>
            </div>
        </section>
    </div>
@endsection
