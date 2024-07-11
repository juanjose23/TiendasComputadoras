@extends('layout.app')

@section('content')
    <section class="h-100 h-custom" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card">
                        <div class="card-body p-4">

                            <div class="row">

                                <div class="col-lg-7">
                                    <h5 class="mb-3"><a href="{{ route('shop') }}" class="text-body"><i
                                                class="fas fa-long-arrow-alt-left me-2"></i> Continuar comprando</a>
                                    </h5>
                                    <hr>

                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div>
                                            <p class="mb-1">Tu carrito de compra</p>
                                            <p class="mb-0">Tienes {{ Cart::getContent()->count() }} productos agregados
                                                en el carrito</p>
                                        </div>
                                        <div>
                                            @if (!is_null($cartItems) && !$cartItems->isEmpty())
                                                <form action="{{ route('cart.clear', $sessionId) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link text-danger"><i
                                                            class="fas fa-trash-alt"></i></button>

                                                    </button>
                                            @endif
                                        </div>
                                    </div>


                                    @foreach (Cart::getContent() as $item)
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div class="d-flex flex-row align-items-center">
                                                        <div class="ms-4 mt-1">
                                                            <img src="{{ $item->attributes->image_url }}"
                                                                class="img-fluid rounded-3" alt="Shopping item"
                                                                style="width: 65px;">
                                                        </div>
                                                        <div class="ms-4 me-4 mt-1">
                                                            <h5> {{ $item->name }}</h5>
                                                            <p class="small mb-0">
                                                                Color:{{ $item->attributes->color }} ,
                                                                Corte:{{ $item->attributes->corte }} ,
                                                                Talla: {{ $item->attributes->talla }}

                                                            </p>
                                                        </div>
                                                    </div>


                                                    <div class="d-flex flex-row align-items-center">
                                                        <div style="width: 50px;">
                                                            <h5 class="fw-normal mb-0">{{ $item->quantity }}</h5>
                                                        </div>
                                                        <div style="width: 80px;">
                                                            <h5 class="mb-0">${{ $item->price }}</h5>
                                                        </div>


                                                        <button type="button" class="btn btn-link text-primary me-2"
                                                            onclick="updateQuantity('{{ $item->id }}')">
                                                            <i class="fas fa-edit"></i>
                                                        </button>

                                                        <form action="{{ route('cart.remove', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-link text-danger"><i
                                                                    class="fas fa-trash-alt"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                <div class="col-lg-5">

                                    <div class="card rounded-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-4">
                                                <h5 class="mb-0 text-black">Detalles de metodos de pagos</h5>
                                                @guest
                                                @else
                                                    <img src="{{ Session::get('Foto') }}" class="img-fluid rounded-3"
                                                        style="width: 45px;" alt="Avatar">
                                                @endguest

                                            </div>

                                            <p class="small mb-2">Metodos de pagos</p>
                                            <p>Stripe</p>


                                            <hr class="my-4">

                                            <div class="d-flex justify-content-between">
                                                <p class="mb-2">Subtotal</p>
                                                <p class="mb-2">C$
                                                    {{ $subtotal = Cart::session($sessionId)->getSubTotal() }}</p>
                                            </div>

                                            <div class="d-flex justify-content-between">
                                                <p class="mb-2">IVA</p>
                                                <p class="mb-2">C$ {{ $iva = $subtotal * 0.15 }}</p>
                                            </div>

                                            <div class="d-flex justify-content-between mb-4">
                                                <p class="mb-2">Total</p>
                                                <p class="mb-2">C$ {{ $total = $subtotal + $iva }}</p>
                                            </div>
                                            @guest
                                                <a href="{{route('login')}}" style="background: black;"
                                                    class="btn btn-link text-primary me-2">
                                                    Iniciar sesion
                                                </a>
                                            @else
                                                <form action="{{ route('stripe') }}" method="post">
                                                    @csrf

                                                    <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                                        style="background: black;" class="btn btn-success btn-block btn-lg">
                                                        <div class="d-flex justify-content-between">
                                                            <span>C${{ $total = $subtotal + $iva }}</span>
                                                            <span>pagar <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                                        </div>
                                                    </button>

                                                </form>
                                            @endguest

                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="
                https://cdn.jsdelivr.net/npm/sweetalert2@11.12.2/dist/sweetalert2.all.min.js
                "></script>
    <link href="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.12.2/dist/sweetalert2.min.css
    " rel="stylesheet">

    <script>
        function updateQuantity(itemId) {
            // Obtener la URL de la acción con el itemId como parte de la ruta
            var actionUrl = "{{ route('cart.update', ['itemId' => ':itemId']) }}";
            actionUrl = actionUrl.replace(':itemId', itemId);

            Swal.fire({
                title: 'Actualizar Cantidad',
                input: 'number',
                inputLabel: 'Nueva Cantidad',
                inputAttributes: {
                    autocorrect: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Actualizar',
                cancelButtonText: 'Cancelar',
                showLoaderOnConfirm: true,
                preConfirm: (quantity) => {
                    // Establecer la acción del formulario con la URL correcta
                    document.querySelector('#updateForm').action = actionUrl;
                    // Asignar la cantidad al input hidden del formulario
                    document.querySelector('#quantityInput').value = quantity;
                    // Enviar el formulario
                    document.querySelector('#updateForm').submit();
                },
                allowOutsideClick: () => !Swal.isLoading()
            });
        }
    </script>

    <form id="updateForm" action="#" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" id="quantityInput" name="quantity">
    </form>
    <script>
        document.getElementById('clearCartBtn').addEventListener('click', function() {
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción eliminará todos los productos del carrito',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar todo '
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = document.getElementById('clearCartForm');
                    form.submit();
                }
            });
        });
    </script>
@endsection
