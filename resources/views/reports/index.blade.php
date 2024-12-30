<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('') }}
        </h2>
    </x-slot>

    <div x-data="{ open: false }" class="flex">
        <!-- Botón para abrir el menú en pantallas pequeñas -->
        <button @click="open = !open" class="lg:hidden p-2 text-white">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Menu lateral -->
        <aside :class="{'block': open, 'hidden': !open}" class="lg:block w-64 bg-gray-900 text-white min-h-screen p-4 shadow-md">
            <div class="flex flex-col items-center mb-6 text-center ">
                <div><img src="{{ asset('images/icono-pages.png') }}" alt="Icono User" class="w-36 h-36 rounded-full"></div> 
                <h3 class="text-lg font-semibold text-gray-300">Listado de Reportes</h3>
            </div>

            <nav>
                <ul class="space-y-4 list-none">
                    <li><a href="{{ route('history')}}" class="block py-2 px-4 rounded-lg text-gray-400 hover:bg-indigo-600 hover:text-white transition duration-300 flex items-center"><img src="{{ asset('images/icono-history.png') }}" alt="Icono Historial" class="w-7 h-7 mr-3">Historial</a></li>
                    <li><a href="{{ route('popups.index')}}" class="block py-2 px-4 rounded-lg text-gray-400 hover:bg-indigo-600 hover:text-white transition duration-300 flex items-center"><img src="{{ asset('images/icono-cameras.png') }}" alt="Icono Camaras" class="w-7 h-7 mr-3">Camaras</a></li>
                    <li><a href="{{ route('dashboard')}}" class="block py-2 px-4 rounded-lg text-gray-400 hover:bg-indigo-600 hover:text-white transition duration-300 flex items-center"><img src="{{ asset('images/icono-home.png') }}" alt="Icono home" class="w-7 h-7 mr-3">Home</a></li>        
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block py-2 px-4 rounded-lg w-full text-left text-gray-400 hover:bg-red-600 hover:text-white transition duration-300">
                                <img src="{{ asset('images/icono-logout.png') }}" alt="Icono Perfil" class="w-7 h-7 mr-3"> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <div class="p-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl font-semibold mb-4">REPORTES</h3>

                    @if(isset($noReportsMessage))
                        <p class="text-gray-500">{{ $noReportsMessage }}</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($reports as $report)
                                <div class="bg-gray-700 rounded-lg shadow-lg p-4">
                                    <img src="{{ asset('images/list-reports.png') }}" alt="Icono Perfil" class="w-11 h-11 mr-3 flex items-center">
                                    <h4 class="text-lg font-bold text-white">{{ $report->camera->name }}</h4>
                                    <p class="text-gray-300 mt-2"><strong>Descripción:</strong> {{ $report->description }}</p>
                                    <p class="text-gray-300 mt-2"><strong>Estatus:</strong> {{ $report->status }}</p>
                                    <p class="text-gray-300 mt-2"><strong>Fecha de reporte:</strong> {{ $report->date }}</p>
                                    <p class="text-gray-300 mt-2"><strong>Generado por:</strong> {{ $report->usereport }}</p>

                                    <!-- Formulario para actualizar estado y añadir solución -->
                                    <form method="POST" action="{{ route('reports.updateStatus', $report->id) }}" class="mt-3 space-y-4">
                                        @csrf
                                        @method('POST')
                                        <!-- Contenedor para la descripción de la solución -->
                                        <div>
                                            <label for="solutions-{{ $report->id }}" class="block text-gray-100 text-sm font-medium mb-1">Descripción de la solución</label>
                                            <textarea id="solutions-{{ $report->id }}" name="solutions" rows="3" class="w-full px-3 py-2 bg-white-600 text-black rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-300">{{ old('solutions', $report->solutions) }}</textarea>
                                        </div>

                                        <div class="flex items-center space-x-2">
                                            <select name="status" class="bg-white-800 text-gray rounded-lg px-3 py-2">
                                                <option value="pendiente" {{ $report->status == 'pendiente' ? 'selected' : '' }} style="color: gray;">Pendiente</option>
                                                <option value="solucionado" {{ $report->status == 'solucionado' ? 'selected' : '' }} style="color: gray;">Solucionado</option>
                                            </select>
                                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition duration-300">Atender</button>
                                        </div>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
    <!-- Integrar SweetAlert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('success'))
                Swal.fire({
                    title: "¡Éxito!",
                    text: "{{ session('success') }}",
                    icon: "success",
                    confirmButtonText: "Aceptar"
                });
            @endif
        });
    </script>

    </div>
</x-app-layout>

