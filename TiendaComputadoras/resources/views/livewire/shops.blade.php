<div>
    <div class="container">
        <div class="page-header wow fadeInUp">
            <h2 class="page-title">Productos</h2>
            <p class="result-count">Mostrando {{ $productos->firstItem() }}–{{ $productos->lastItem() }} de
                {{ $productos->total() }} resultados</p>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="container">
                    <div class="row">
                   
                        @foreach ($productos as $producto)
                            <div class="col-md-4 product-card wow fadeInUp">
                                <div class="product-thumbnail-wrapper">
                                    <img src="{{$producto->url}}" alt="product"
                                        class="product-thumbnail">
                                </div>
                                <h5 class="product-title">
                                    {{ $producto->nombre }}
                                </h5>
                                <p class="product-price">

                                    C$ {{ $producto->precio }}
                                </p>
                                <div class="btn-wrapper">
                                    <button class="btn btn-add-to-cart">Añadir al carrito</button>
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
                                        {{ $producto->nombre }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        <strong>Modelo:</strong> {{ $producto->nombre_modelo }}
                                        <strong>Marca:</strong> {{ $producto->nombre_marca }} <br>
                                        <strong>Categoría:</strong> {{ $producto->nombre_categoria }} <br>
                                        <strong>Sub Categoría:</strong> {{ $producto->nombre_subcategoria }} <br>
                                        <strong>Color:</strong> {{ $producto->nombre_color }} <br>
                                        <strong>Talla:</strong> {{ $producto->nombre_talla }} <br>
                                        <strong>Corte:</strong> {{ $producto->nombre_corte }} <br>

                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary">Añadir al carrito</button>
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
                        @foreach ( $marcas as $marca )
                        <a href="#!" class="post-tag">{{$marca->nombre}}</a>
                        @endforeach
                      
                      
                    </div>
                </div>
                <div class="sidebar-widget wow fadeInUp">
                    <h5 class="widget-title">Categoria</h5>
                    <div class="widget-content">
                        @foreach ( $categorias as $categoria )
                        <a href="#!" class="post-tag">{{$categoria->nombre}}</a>
                        @endforeach
                    </div>
                </div>
                <div class="sidebar-widget wow fadeInUp">
                    <h5 class="widget-title">Colores</h5>
                    <div class="widget-content">
                        @foreach ( $colores as $color )
                        <a href="#!" style="border-color:{{$color->codigo}}" class="post-tag">{{$color->nombre}}</a>
                        @endforeach
                    </div>
                </div>
                <div class="sidebar-widget wow fadeInUp">
                    <h5 class="widget-title">Tallas</h5>
                    <div class="widget-content">
                        @foreach ( $tallas as $talla )
                        <a href="#!" class="post-tag">{{$talla->nombre}}</a>
                        @endforeach
                    </div>
                </div>
                <div class="sidebar-widget wow fadeInUp">
                    <h5 class="widget-title">Cortes</h5>
                    <div class="widget-content">
                        @foreach ( $cortes as $corte )
                        <a href="#!" class="post-tag">{{$corte->nombre}}</a>
                        @endforeach
                    </div>
                </div>
               
              
               
            </div>
            <div class="col-md-12">
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

        </div>
    </div>

</div>
