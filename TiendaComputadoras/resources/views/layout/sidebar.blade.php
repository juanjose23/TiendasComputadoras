<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="">
            <img src="{{ $empresa ['imagen']->url }}"
                class="" alt="" width="40" height="40">
            <span class="align-middle">{{ $empresa ['company']->nombre }}</span>
        </a>


        <ul class="sidebar-nav">
            @foreach (Session::get('privilegios') as $modulo)
                <li class="sidebar-item">
                    <a data-bs-target="#{{ Str::slug($modulo['nombre']) }}" data-bs-toggle="collapse"
                        class="sidebar-link collapsed">
                        <i class="icono align-middle" data-feather='{{ $modulo['icono'] }}'></i>
                        <span class="align-middle">{{ $modulo['nombre'] }}</span>
                    </a>
                    @if (!empty($modulo['submodulos']))
                        <ul id="{{ Str::slug($modulo['nombre']) }}" class="sidebar-dropdown list-unstyled collapse "
                            data-bs-parent="#sidebar">
                            @foreach ($modulo['submodulos'] as $submodulo)
                                <li class="sidebar-item">
                                    @if ($submodulo['enlace'])
                                    <a href="{{ route($submodulo['enlace'])}}"  class='sidebar-link text-white-50'> {{ $submodulo['nombre'] }}</a>
                                    @else
                                        <a href="" class="sidebar-link text-white-50"> {{ $submodulo['nombre'] }}</a>
                                    @endif



                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach

        </ul>


    </div>
</nav>
