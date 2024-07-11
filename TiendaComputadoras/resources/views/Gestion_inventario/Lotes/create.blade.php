@extends('layout.layouts')
@section('title', 'Solicitud')
@section('submodulo', 'Lotes')
@section('content')
    <div class="row">
        <section class="col-md-12 col-xl-12">
            <div class="card mb-12">
                <div class="card-body ">
                    <form class="row" action="{{ route('lotes.store') }}" id="formulario" method="POST"
                        enctype="multipart/form-data">
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
                                <label for="precio" class="form-label text-dark">Precio</label>
                                <input type="text" id="precio" name="precio" placeholder="Escribe la cantidad"
                                    class="form-control @error('precio') is-invalid @enderror" value="{{ old('precio') }}">
                                @error('cantidad')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iva" class="form-label text-dark">IVA en porcentaje</label>
                                <input type="text" id="iva" name="iva"
                                    placeholder="Escribe el porcentaje de IVA"
                                    class="form-control @error('iva') is-invalid @enderror" value="{{ old('iva') }}">
                                @error('iva')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>



                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="proveedores" class="form-label text-dark">Proveedor</label>
                                <select style="width: 100%" id="proveedores" name="proveedores"
                                    class="form-control buscador @error('proveedores') is-invalid @enderror">
                                    <option>Elegir proveedor</option>
                                    @foreach ($proveedores as $pais)
                                        <option value="{{ $pais->id }}"
                                            {{ old('proveedores') == $pais->id ? 'selected' : '' }}>
                                            {{ $pais->personas->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('proveedores')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <input type="hidden" id="productos-json" name="productos">
                        <div class="col-md-12">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                                <a href="{{ route('lotes.index') }}" class="btn btn-danger mb-2 me-md-2">Cancelar</a>
                                <button id="registrar" type="submit" class="btn btn-primary mb-2" disabled>Registrar
                                    lote</button>
                                <button type="button" id="agregar" class="btn btn-secondary mb-2">Agregar
                                    producto</button>
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
                                    <th>Precio</th>
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

            cargarProductosEnFormulario();


            const formulario = document.getElementById('formulario');
            formulario.addEventListener('submit', function(event) {
                event.preventDefault();
                const productos = JSON.parse(localStorage.getItem('productos')) || [];

                // Agregar productos como un campo oculto en el formulario
                document.getElementById('productos-json').value = JSON.stringify(productos);

                // Obtener valores de los campos
                const iva = document.getElementById('iva').value.trim();
                const proveedor = document.getElementById('proveedores').value.trim();

                // Validar campo IVA
                if (iva === '') {
                    mostrarAlertaError('Por favor, ingrese el porcentaje de IVA.');
                    console.log("iva")
                    return;
                } else if (isNaN(iva) || parseFloat(iva) < 0) {
                    mostrarAlertaError('El porcentaje de IVA debe ser un número positivo.');
                    return;
                }

                // Validar campo Proveedor
                if (proveedor === '') {
                    mostrarAlertaError('Por favor, seleccione un proveedor.');
                    return;
                }


                this.submit();
                localStorage.clear();

            });
            verificarProductos();

           

        });
        function mostrarAlertaError(mensaje) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: mensaje,
                    confirmButtonText: 'OK'
                });
            }
        document.getElementById('agregar').addEventListener('click', function() {
            const productoSelect = document.getElementById('producto');
            const cantidadInput = document.getElementById('cantidad');
            const PrecioInput = document.getElementById('precio');
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
            const precio = PrecioInput.value;

            if (!productoSelect.value || !cantidad) {
                Swal.fire('Error', 'Por favor, seleccione un producto y escriba una cantidad.', 'error');
                return;
            }
            if (!cantidad) {
                Swal.fire('Error', 'Por favor, seleccione un precio.', 'error');
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
                <td>${precio}</td>
                <td>  
                    <div class="d-flex mb-1 align-items-center">
                        <div class=" me-1">
                            <button class="btn btn-warning  btn-block" onclick="actualizarCantidad(this, '${productoId}')">  <i class="fas fa-edit"></i></button>
                        </div>
                        <div class="flex me-1">
                            <button class="btn btn-primary  btn-block" onclick="actualizarCantidads(this, '${productoId}')"> <i class="fas fa-dollar-sign"></i> </button>
                        </div>
                        <div class="flex me-1">
                            <button class="btn btn-danger  btn-block" onclick="eliminarFila(this, '${productoId}')"><i class="fas fa-trash-alt"></i></button>
                        </div>
                   </div>
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
                cantidad: cantidad,
                precio: precio
            });

            // Limpiar los campos después de agregar el producto
            verificarProductos();
            productoSelect.selectedIndex = 0;
            cantidadInput.value = '';
            PrecioInput.value = '';
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
            const row = button.parentElement.parentElement.parentElement.parentElement;
            const cantidadCell = row.cells[6];
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

        function actualizarCantidads(button, id) {
            const row = button.parentElement.parentElement.parentElement.parentElement;
            const cantidadCell = row.cells[7];
            const currentCantidad = cantidadCell.textContent;

            Swal.fire({
                title: 'Actualizar Precio de compra',
                input: 'text',
                inputValue: currentCantidad,
                showCancelButton: true,
                confirmButtonText: 'Actualizar',
                cancelButtonText: 'Cancelar',
                preConfirm: (newCantidad) => {
                    if (!newCantidad) {
                        Swal.showValidationMessage('Por favor, ingrese un precio válido.');
                    }
                    return newCantidad;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    cantidadCell.textContent = result.value;
                    actualizarPrecio(id, result.value);
                    Swal.fire('Actualizado!', 'El precio ha sido actualizada.', 'success');
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

        function actualizarPrecio(id, precio) {
            let productos = JSON.parse(localStorage.getItem('productos')) || [];
            productos = productos.map(producto => {
                if (producto.id === id) {
                    producto.precio = precio;
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
                <td>${producto.precio}</td>
                <td>
                    <div class="d-flex mb-1 align-items-center">
                        <div class=" me-1">
                            <button class="btn btn-warning  btn-small" onclick="actualizarCantidad(this, '${producto.id}')"><i class="fas fa-edit"></i></button>
                        </div>
                        <div class="flex me-1">
                            <button class="btn btn-primary  btn-small" onclick="actualizarCantidads(this, '${producto.id}')"><i class="fas fa-dollar-sign"></i> </button>
                        </div>
                        <div class="flex me-1">
                            <button class="btn btn-danger  btn-small" onclick="eliminarFila(this, '${producto.id}')"><i class="fas fa-trash-alt"></i></button>
                        </div>
                   </div>
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
