@extends('layout.layouts')
@section('title', 'Solicitud')
@section('submodulo', 'Solicitud de compra')
@section('content')
    <div class="row">
        <section class="col-md-12 col-xl-12">
            <div class="card mb-12">
                <div class="card-body ">
                    <form class="row" action="{{route('solicitud.store')}}" id="formulario" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="producto" class="form-label text-dark">Productos</label>
                                <select id="producto" name="producto"
                                    class="form-select buscador @error('producto') is-invalid @enderror"
                                    style="width: 100%">
                                    <option selected disabled>Elegir Productos</option>
                                    @foreach ($productos as $categorias => $subcategoria)
                                        <optgroup label="{{ $categorias }}">
                                            @foreach ($subcategoria as $productos => $producto)
                                        <optgroup label="{{ $productos }}">
                                            @foreach ($producto as $producto)
                                                <option value="{{ $producto['id'] }}"
                                                    {{ old('producto') == $producto['id'] ? 'selected' : '' }}
                                                    data-id="{{ $producto['id'] }}" data-modelo="{{ $producto['modelo'] }}"
                                                    data-codigo="{{ $producto['codigo'] }}"
                                                    data-nombre="{{ $producto['nombre'] }}"
                                                    data-color="{{ $producto['color'] }}"
                                                    data-corte="{{ $producto['corte'] }}"
                                                    data-talla="{{ $producto['tallas'] }}"
                                                    data-marca="{{ $producto['marca'] }}">

                                                    Producto: {{ $producto['nombre'] }} Marca: {{ $producto['marca'] }}
                                                    Modelo:
                                                    {{ $producto['modelo'] }} Color: {{ $producto['color'] }} Corte:
                                                    {{ $producto['corte'] }} Talla: {{ $producto['tallas'] }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                    </optgroup>
                                    @endforeach
                                </select>
                                @error('producto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cantidad" class="form-label text-dark">Cantidad</label>
                                <input type="text" id="cantidad" name="cantidad" placeholder="Escribe la cantidad"
                                    class="form-control @error('cantidad') is-invalid @enderror"
                                    value="{{ old('cantidad') }}">
                                @error('cantidad')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha" class="form-label text-dark">Fecha de Entrega</label>
                                <input type="date" id="fecha" name="fecha"
                                       class="form-control @error('fecha') is-invalid @enderror"
                                       value="{{ old('fecha') }}" required>
                                @error('fecha')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descripcion" class="form-label text-dark">Notas </label>
                                <textarea id="descripcion" name="descripcion" rows="3"
                                    class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion') }}</textarea>
                                @error('descripcion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <input type="hidden" id="productos-json" name="productos">
                        <div class="col-md-12">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                                <a href="{{ route('solicitud.index') }}" class="btn btn-danger mb-2 me-md-2">Cancelar</a>
                                <button id="registrar" type="submit" class="btn btn-primary mb-2" disabled>Registrar
                                    Solicitud</button>
                                <button id="agregar" class="btn btn-secondary mb-2">Agregar a la Solicitud</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </section>
        <section class="col-md-12 col-xl-12">
            <div class="card mb-12">
                <div class="card-header">
                    <h2>Lista de productos solicitados</h2>
                </div>
                <div class="card-body text-center">
                    <div class="table-responsive">
                        <table id="solicitud" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Color</th>
                                    <th>Corte</th>
                                    <th>Talla</th>
                                    <th>Cantidad</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>



                </div>
            </div>
        </section>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Cargar datos desde el localStorage al cargar la página
            cargarProductos();
            verificarProductos();
            cargarProductosEnFormulario();

            const formulario = document.getElementById('formulario');
            formulario.addEventListener('submit', function(event) {
                event.preventDefault(); 
                const productos = JSON.parse(localStorage.getItem('productos')) || [];

                // Agregar productos como un campo oculto en el formulario
                document.getElementById('productos-json').value = JSON.stringify(productos);

                // Obtener la fecha actual
                const fechaActual = new Date();
                const fechaIngresada = new Date(document.getElementById('fecha').value);

                // Comparar las fechas
                if (fechaIngresada <= fechaActual) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'La fecha de entrega debe ser mayor a la fecha actual.'
                    });
                    document.getElementById('fecha').classList.add('is-invalid');
                    return;
                } else {
                    // Si la fecha es válida, quitar el estilo de error si estaba presente
                    document.getElementById('fecha').classList.remove('is-invalid');

                }

                // Si la fecha es válida, enviar el formulario
                this.submit();
            });


        });
        document.getElementById('agregar').addEventListener('click', function() {
            const productoSelect = document.getElementById('producto');
            const cantidadInput = document.getElementById('cantidad');
            const solicitudTable = document.getElementById('solicitud').getElementsByTagName('tbody')[0];
            const selectedOption = productoSelect.options[productoSelect.selectedIndex];
            const productoId = selectedOption.getAttribute('data-id');
            const productoModelo = selectedOption.getAttribute('data-modelo');
            const productoColor = selectedOption.getAttribute('data-color');
            const productoTalla = selectedOption.getAttribute('data-talla');
            const productoCorte = selectedOption.getAttribute('data-corte');
            const productoNombre = selectedOption.getAttribute('data-nombre');
            const productoMarca = selectedOption.getAttribute('data-marca');
            const cantidad = cantidadInput.value;

            if (!productoSelect.value || !cantidad) {
                Swal.fire('Error', 'Por favor, seleccione un producto y escriba una cantidad.', 'error');
                return;
            }

            // Verificar si el producto ya existe en la tabla
            if (document.querySelector(`tr[data-id='${productoId}']`)) {
                Swal.fire('Error', 'El producto ya está en la lista.', 'error');
                return;
            }

            const newRow = solicitudTable.insertRow();
            newRow.setAttribute('data-id', productoId);
            newRow.innerHTML = `
                <td>${productoNombre}</td>
                <td>${productoMarca}</td>
                <td>${productoModelo}</td>
                <td>${productoColor}</td>
                <td>${productoCorte}</td>
                <td>${productoTalla}</td>
                <td>${cantidad}</td>
                <td>
                    <button class="btn btn-warning btn-sm" onclick="actualizarCantidad(this, '${productoId}')">Actualizar</button>
                    <button class="btn btn-danger btn-sm" onclick="eliminarFila(this, '${productoId}')">Eliminar</button>
                </td>
            `;

            // Guardar en localStorage
            guardarProducto({
                id: productoId,
                nombre: productoNombre,
                marca: productoMarca,
                modelo: productoModelo,
                color: productoColor,
                corte: productoCorte,
                Talla: productoTalla,
                cantidad: cantidad
            });

            // Limpiar los campos después de agregar el producto
            productoSelect.selectedIndex = 0;
            cantidadInput.value = '';
        });

        function eliminarFila(button, id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminarlo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const row = button.parentElement.parentElement;
                    row.remove();
                    eliminarProducto(id);
                    Swal.fire('Eliminado!', 'El producto ha sido eliminado.', 'success');
                }
            });
        }

        function actualizarCantidad(button, id) {
            const row = button.parentElement.parentElement;
            const cantidadCell = row.cells[2];
            const currentCantidad = cantidadCell.textContent;

            Swal.fire({
                title: 'Actualizar Cantidad',
                input: 'text',
                inputValue: currentCantidad,
                showCancelButton: true,
                confirmButtonText: 'Actualizar',
                cancelButtonText: 'Cancelar',
                preConfirm: (newCantidad) => {
                    if (!newCantidad) {
                        Swal.showValidationMessage('Por favor, ingrese una cantidad válida.');
                    }
                    return newCantidad;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    cantidadCell.textContent = result.value;
                    actualizarProducto(id, result.value);
                    Swal.fire('Actualizado!', 'La cantidad ha sido actualizada.', 'success');
                }
            });
        }

        function guardarProducto(producto) {
            let productos = JSON.parse(localStorage.getItem('productos')) || [];
            productos.push(producto);
            localStorage.setItem('productos', JSON.stringify(productos));
        }

        function eliminarProducto(id) {
            let productos = JSON.parse(localStorage.getItem('productos')) || [];
            productos = productos.filter(producto => producto.id !== id);
            localStorage.setItem('productos', JSON.stringify(productos));
        }

        function actualizarProducto(id, cantidad) {
            let productos = JSON.parse(localStorage.getItem('productos')) || [];
            productos = productos.map(producto => {
                if (producto.id === id) {
                    producto.cantidad = cantidad;
                }
                return producto;
            });
            localStorage.setItem('productos', JSON.stringify(productos));
        }

        function cargarProductos() {
            let productos = JSON.parse(localStorage.getItem('productos')) || [];
            const solicitudTable = document.getElementById('solicitud').getElementsByTagName('tbody')[0];
            productos.forEach(producto => {
                const newRow = solicitudTable.insertRow();
                newRow.setAttribute('data-id', producto.id);
                newRow.innerHTML = `
                <td>${producto.nombre}</td>
                <td>${producto.marca}</td>
                <td>${producto.modelo}</td>
                <td>${producto.color}</td>
                <td>${producto.corte}</td>
                <td>${producto.Talla}</td>
                <td>${producto.cantidad}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="actualizarCantidad(this, '${producto.id}')">Actualizar</button>
                        <button class="btn btn-danger btn-sm" onclick="eliminarFila(this, '${producto.id}')">Eliminar</button>
                    </td>
                `;
            });
        }

        function cargarProductosEnFormulario() {
            const productos = JSON.parse(localStorage.getItem('productos')) || [];
            const productosContainer = document.getElementById('productos-container');
            const productosJsonInput = document.getElementById('productos-json');
            productosJsonInput.value = JSON.stringify(productos);
        }

        function verificarProductos() {
            let productos = JSON.parse(localStorage.getItem('productos')) || [];
            const botonRegistrar = document.getElementById('registrar');
            if (productos.length > 0) {
                botonRegistrar.removeAttribute('disabled');
            } else {
                botonRegistrar.setAttribute('disabled', 'disabled');
            }
        }
    </script>

@endsection
