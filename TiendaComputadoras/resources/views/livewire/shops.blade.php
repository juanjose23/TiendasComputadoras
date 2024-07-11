<div>
    <div class="container">
        <div class="page-header wow fadeInUp">
            <h2 class="page-title">Productos</h2>

            <div class="result-count-container d-flex justify-content-between align-items-center my-3">
                <p class="mb-0">
                    Mostrando {{ $productos->firstItem() ?? 0 }}–{{ $productos->lastItem() ?? 0 }} de
                    {{ $productos->total() }} resultados
                </p>


            </div>

        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="container">
                    <div class="row">

                        @foreach ($productos as $producto)
                            <div class="col-md-4 product-card wow fadeInUp">
                                <div class="product-thumbnail-wrapper">
                                    @if ($producto->imagenes)
                                        <img src="{{ $producto->imagenes->url }}" alt="Imagen del producto"
                                            class="product-thumbnail">
                                    @else
                                        <img src="assets/images/Shop/1.jpg" alt="product" class="product-thumbnail">
                                    @endif
                                </div>
                                <h5 class="product-title">
                                    {{ $producto->productos->nombre }}
                                </h5>
                                <p class="product-price">
                                    @foreach ($producto->precios as $precio)
                                        <p>Precio: {{ $precio->precio }}</p>
                                    @endforeach
                                </p>
                                <div class="btn-wrapper">

                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $producto->id }}">
                                        <input type="hidden" name="name" value="{{ $producto->productos->nombre }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <!-- Puedes manejar la cantidad dinámicamente si lo necesitas -->
                                        <input type="hidden" name="precio"
                                            value="{{ $producto->precios->first()->precio }}">
                                        <input type="hidden" name="image_url"
                                            value="{{ $producto->imagenes ? $producto->imagenes->url : 'assets/images/Shop/1.jpg' }}">
                                        <input type="hidden" name="corte"
                                            value="{{ $producto->cortesproductos->cortes->nombre }}">
                                        <input type="hidden" name="talla"
                                            value="{{ $producto->tallasproductos->tallas->nombre }}">
                                        <input type="hidden" name="color"
                                            value="{{ $producto->coloresproductos->colores->nombre }}">
                                        <input type="hidden" name="genero"
                                            value="{{ $producto->generos->nombre }}">
                                        <button type="submit" class="btn btn-add-to-cart">Añadir al carrito</button>
                                    </form>
                                    <button class="btn btn-details" data-toggle="modal"
                                        data-target="#modalProducto{{ $producto->id }}">Ver detalles</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @foreach ($productos as $producto)
                    <!-- Modal -->
                    <div class="modal fade" id="modalProducto{{ $producto->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="modalProductoLabel{{ $producto->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalProductoLabel{{ $producto->id }}">
                                        {{ $producto->productos->nombre }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <strong>Modelo:</strong> {{ $producto->productos->modelos->nombre }}
                                    <br>
                                    <strong>Marca:</strong> {{ $producto->productos->modelos->marcas->nombre }} <br>
                                    <strong>Categoría:</strong>
                                    {{ $producto->productos->subcategorias->categorias->nombre }} <br>
                                    <strong>Sub Categoría:</strong> {{ $producto->productos->subcategorias->nombre }}
                                    <br>
                                    <strong>Color:</strong> {{ $producto->coloresproductos->colores->nombre }} <br>
                                    <strong>Corte:</strong> {{ $producto->cortesproductos->cortes->nombre }} <br>
                                    <strong>Talla:</strong> {{ $producto->tallasproductos->tallas->nombre }} <br>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Cerrar</button>
                                        <form action="{{ route('cart.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $producto->id }}">
                                            <input type="hidden" name="name" value="{{ $producto->productos->nombre }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <!-- Puedes manejar la cantidad dinámicamente si lo necesitas -->
                                            <input type="hidden" name="precio"
                                                value="{{ $producto->precios->first()->precio }}">
                                            <input type="hidden" name="image_url"
                                                value="{{ $producto->imagenes ? $producto->imagenes->url : 'assets/images/Shop/1.jpg' }}">
                                            <input type="hidden" name="corte"
                                                value="{{ $producto->cortesproductos->cortes->nombre }}">
                                            <input type="hidden" name="talla"
                                                value="{{ $producto->tallasproductos->tallas->nombre }}">
                                            <input type="hidden" name="color"
                                                value="{{ $producto->coloresproductos->colores->nombre }}">
                                            <input type="hidden" name="genero"
                                                value="{{ $producto->generos->nombre}}">
                                            <button type="submit" class="btn btn-add-to-cart">Añadir al carrito</button>
                                        </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-lg-4">
                <div class="sidebar-widget wow fadeInUp">
                    <h5 class="widget-title">Marcas</h5>
                    <div class="widget-content">
                        @foreach ($marcas as $marca)
                            <a href="#!" class="post-tag">{{ $marca->nombre }}</a>
                        @endforeach


                    </div>
                </div>
                <div class="sidebar-widget wow fadeInUp">
                    <h5 class="widget-title">Categoria</h5>
                    <div class="widget-content">
                        @foreach ($categorias as $categoria)
                            <a href="#!" class="post-tag">{{ $categoria->nombre }}</a>
                        @endforeach
                    </div>
                </div>
                <div class="sidebar-widget wow fadeInUp">
                    <h5 class="widget-title">Colores</h5>
                    <div class="widget-content">
                        @foreach ($colores as $color)
                            <a href="#!" style="border-color:{{ $color->codigo }}"
                                class="post-tag">{{ $color->nombre }}</a>
                        @endforeach
                    </div>
                </div>
                <div class="sidebar-widget wow fadeInUp">
                    <h5 class="widget-title">Tallas</h5>
                    <div class="widget-content">
                        @foreach ($tallas as $talla)
                            <a href="#!" class="post-tag">{{ $talla->nombre }}</a>
                        @endforeach
                    </div>
                </div>
                <div class="sidebar-widget wow fadeInUp">
                    <h5 class="widget-title">Cortes</h5>
                    <div class="widget-content">
                        @foreach ($cortes as $corte)
                            <a href="#!" class="post-tag">{{ $corte->nombre }}</a>
                        @endforeach
                    </div>
                </div>



            </div>
            <div class="col-md-6">
                <nav class="oleez-pagination wow fadeInUp">
                    {{-- Botón de página anterior --}}
                    @if ($productos->onFirstPage())
                        <a href="#!" class="disabled">&larr;</a>
                    @else
                        <a href="{{ $productos->previousPageUrl() }}">&larr;</a>
                    @endif

                    {{-- Enlaces de páginas --}}
                    @foreach ($productos->getUrlRange(1, $productos->lastPage()) as $page => $url)
                        <a href="{{ $url }}"
                            class="{{ $page == $productos->currentPage() ? 'active' : '' }}">{{ $page }}</a>
                    @endforeach

                    {{-- Botón de página siguiente --}}
                    @if ($productos->hasMorePages())
                        <a href="{{ $productos->nextPageUrl() }}">&rarr;</a>
                    @else
                        <a href="#!" class="disabled">&rarr;</a>
                    @endif
                </nav>
            </div>
            <div class="col-md-6 d-flex justify-content-between align-items-center my-3">
                <div class="form-group mb-2">
                    <label for="buscador" class="form-label">Mostrar:</label>
                    <select name="buscador" id="buscador" wire:model.live="perPage" class="form-control">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="0">Todos</option>
                    </select>
                </div>

            </div>

        </div>
    </div>

</div>
