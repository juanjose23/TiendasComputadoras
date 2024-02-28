<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="">
            <img src="https://res.cloudinary.com/dxtlbsa62/image/upload/v1708926952/Blue_Computer_Electronic_Logo_4_e3gikf.png" class="" alt="" width="60">
            <span class="align-middle">ElectrocTech</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Gestión de catalogos
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#productos" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="shopping-bag"></i>
<span class="align-middle">Gestión de productos</span>

                </a>
                <ul id="productos" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class='sidebar-link text-white-50' href='/pages-projects'>Categorias </a></li>
                    <li class="sidebar-item"><a class='sidebar-link text-white-50' href='/pages-clients'>Marcas </a></li>
                    <li class="sidebar-item"><a class='sidebar-link text-white-50' href='/pages-orders'>Modelos</a></li>
                    <li class="sidebar-item"><a class='sidebar-link text-white-50' href='/pages-pricing'>Colores </a></li>
                    <li class="sidebar-item"><a class='sidebar-link text-white-50' href='/pages-chat'>Productos</a></li>
                    <li class="sidebar-item"><a class='sidebar-link text-white-50' href='/pages-blank'>Precios productos</a></li>
                </ul>
            </li>
            <li class="sidebar-header">
                Gestión de compras
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#inventario" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="archive"></i>
                    <span class="align-middle">Gestión de Inventarios</span>
                    
                </a>
                <ul id="inventario" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class='sidebar-link text-white-50' href='/pages-projects'>Proveedores</a></li>
                    <li class="sidebar-item"><a class='sidebar-link text-white-50' href='/pages-clients'>Stock</a></li>
                    <li class="sidebar-item"><a class='sidebar-link text-white-50' href='/pages-orders'>Movimientos</a></li>
                    <li class="sidebar-item"><a class='sidebar-link text-white-50' href='/pages-pricing'>Gestión de ubicaciones</a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#compras" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="layout"></i>
                    <span class="align-middle">Gestión de
                        compras</span>
                </a>
                <ul id="compras" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class='sidebar-link text-white-50' href='/pages-projects'>Solicitudes </a></li>
                    <li class="sidebar-item"><a class='sidebar-link text-white-50' href='/pages-clients'>Cotizaciones </a></li>
                    <li class="sidebar-item"><a class='sidebar-link text-white-50' href='/pages-orders'>Ordenes</a></li>
                    <li class="sidebar-item"><a class='sidebar-link text-white-50' href='/pages-pricing'>Compras </a></li>
                    <li class="sidebar-item"><a class='sidebar-link text-white-50' href='/pages-chat'>Devoluciones</a></li>
                    <li class="sidebar-item"><a class='sidebar-link text-white-50' href='/pages-blank'>Recepciones</a></li>
                </ul>
            </li>
          
            <li class="sidebar-item">
                <a data-bs-target="#negocio" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="briefcase"></i>
                    <span class="align-middle">Gestión de Negocio</span>
                    
                </a>
                <ul id="negocio" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class='sidebar-link text-white-50' href='{{ route('cargos.index')}}'>Cargos</a></li>
                    <li class="sidebar-item"><a class='sidebar-link text-white-50' href='{{ route('colaboradores.index')}}'>Colaboradores</a></li>
                    <li class="sidebar-item"><a class='sidebar-link text-white-50' href='{{route('asignaciones.index')}}'>Asignacion de cargos</a></li>
                    <li class="sidebar-item"><a class='sidebar-link text-white-50' href='/pages-pricing'>Salarios </a></li>

                </ul>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#Ventas" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="trending-up"></i>
                    <span class="align-middle">Gestión de Ventas</span>
                    
                </a>
                <ul id="Ventas" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class='sidebar-link text-white-50' href='/pages-projects'>Pedidos</a></li>
                    <li class="sidebar-item"><a class='sidebar-link text-white-50' href='/pages-clients'>Cotizaciones </a></li>
                    <li class="sidebar-item"><a class='sidebar-link text-white-50' href='/pages-orders'>Ventas</a></li>
                    <li class="sidebar-item"><a class='sidebar-link text-white-50' href='/pages-pricing'>Entregas </a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#caja" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="box"></i>
                    <span class="align-middle">Gestión de Cajas</span>
                    
                </a>
                <ul id="caja" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class='sidebar-link text-white-50' href='/pages-projects'>Caja </a></li>
                    <li class="sidebar-item"><a class='sidebar-link text-white-50' href='/pages-projects'>Apertura </a></li>
                    <li class="sidebar-item"><a class='sidebar-link text-white-50' href='/pages-clients'>Arqueo </a></li>
                    <li class="sidebar-item"><a class='sidebar-link text-white-50' href='/pages-orders'>Cierre</a></li>
                    <li class="sidebar-item"><a class='sidebar-link text-white-50' href='/pages-blank'>Configuraciones</a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#usuarios" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="users"></i>
                    <span class="align-middle">Gestión de Usuarios</span>
                    
                </a>
                <ul id="usuarios" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class='sidebar-link text-white-50' href='/pages-projects'>Roles</a></li>
                    <li class="sidebar-item"><a class='sidebar-link text-white-50' href='/pages-clients'>Usuarios</a></li>
                    <li class="sidebar-item"><a class='sidebar-link text-white-50' href='/pages-orders'>Privilegios</a></li>
                    <li class="sidebar-item"><a class='sidebar-link text-white-50' href='/pages-pricing'>Permisos</a></li>
                    <li class="sidebar-item"><a class='sidebar-link text-white-50' href='/pages-chat'>Conexiones</a></li>
                </ul>
            </li>
        </ul>


    </div>
</nav>
