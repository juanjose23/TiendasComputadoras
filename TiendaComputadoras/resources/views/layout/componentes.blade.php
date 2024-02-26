<div class="d-flex justify-content-between">
    <div class="input-group mb-3" style="max-width: 300px;">
        <input type="text" class="form-control form-control rounded-start"
            placeholder="Buscar...">

    </div>
    <!-- Contenedor con alineación a la derecha -->
    <div class="d-flex justify-content-end w-100">
        <!-- Botón para crear un cargo -->
        <div class="dropdown">
            <div class="btn-group ms-2">
                <a href="{{ route('cargos.create') }}"
                    class="btn btn-success btn-icon ">
                    <i class="bi bi-file-earmark-plus-fill"></i> Crear cargo
                </a>
            </div>
        </div>

        <!-- Botón de exportación -->
        <div class="btn-group ms-2">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle btn-icon"
                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-box-arrow-up-right"></i> Exportaciones
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#"><i
                                class="bi bi-file-earmark-spreadsheet text-success"></i>
                            Exportar a Excel</a></li>
                    <li><a class="dropdown-item" href="#"><i
                                class="bi bi-file-pdf text-danger"></i> Exportar a
                            PDF</a></li>
                </ul>
            </div>
        </div>

        <!-- Botón para seleccionar cantidad de registros a mostrar -->
        <div class="btn-group ms-2">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle btn-icon"
                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-list"></i> Mostrar en
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">5</a></li>
                    <li><a class="dropdown-item" href="#">10</a></li>
                    <li><a class="dropdown-item" href="#">20</a></li>
                    <li><a class="dropdown-item" href="#">50</a></li>
                    <li><a class="dropdown-item" href="#">Todos</a></li>
                </ul>
            </div>
        </div>
    </div>

</div>
