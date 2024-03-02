<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de colaboradores</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

</head>

<body>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="flex items-center flex-1 space-x-4">
            <h5>
                <span class="text-gray-500">Lista de colaboradores</span>

            </h5>
            <h5>
                <span class="dark:text-white">Total de colaboradores: {{$total}}</span>
            </h5>

        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-4 py-2">
                        Código
                    </th>
                    <th scope="col" class="px-4 py-2">
                        Nombre
                    </th>
                    <th scope="col" class="px-4 py-2">
                        Apellido
                    </th>
                    <th scope="col" class="px-4 py-2">
                        Codigo Inss
                    </th>
                    <th scope="col" class="px-4 py-2">
                        Telefono
                    </th>
                    <th scope="col" class="px-4 py-2">
                        Correo
                    </th>
                    <th scope="col" class="px-4 py-2">
                        Tipo de identificación
                    </th>
                    <th scope="col" class="px-4 py-2">
                        Identificación
                    </th>

                    <th scope="col" class="px-4 py-2">
                        Nacionalidad
                    </th>
                    <th scope="col" class="px-4 py-2">
                        Estado
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($empleados as $empleados)
                    :
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-2 py-2">
                            {{ $empleados->codigo }}
                        </td>
                        <th scope="row"
                            class="flex items-center px-2 py-2 text-gray-900 whitespace-nowrap dark:text-white">
                            <img class="w-10 h-10 rounded-full" src="{{ $empleados->personas->foto }}" alt="Jese image">
                            <div class="ps-3">
                                <div class="text-base font-semibold">{{ $empleados->personas->nombre }}</div>

                            </div>
                        </th>
                        <td class="px-2 py-2">
                            {{ $empleados->personas->persona_naturales->apellido }}
                        </td>
                        <td class="px-2 py-2">
                            {{ $empleados->inss }}
                        </td>
                        <td class="px-2 py-2">
                            {{ $empleados->personas->telefono }}
                        </td>
                        <td class="px-2 py-2">
                            {{ $empleados->personas->correo }}
                        </td>
                        <td class="px-2 py-2">
                            {{ $empleados->personas->persona_naturales->tipo_identificacion }}
                        </td>
                        <td class="px-2 py-2">
                            {{ $empleados->personas->persona_naturales->identificacion }}
                        </td>
                        <td class="px-2 py-2">
                            {{ $empleados->personas->persona_naturales->paises->nombre }}
                        </td>

                        <td class="px-2 py-2">

                            @php
                                $estadoClass = $empleados->estado == 1 ? 'bg-green-500' : 'bg-red-500';
                                $estadoTexto = $empleados->estado == 1 ? 'Activo' : 'Inactivo';
                            @endphp
                            <span
                                class="inline-block px-2 py-1 rounded-full text-sm font-semibold {{ $estadoClass }} text-success mr-2">{{ $estadoTexto }}</span>
                        </td>


                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>
