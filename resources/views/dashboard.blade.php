<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Panel Principal') }}
        </h2>
    </x-slot>

    <div x-data="{ open: false }" class="flex">
        <!-- Botón para abrir el menú en pantallas pequeñas -->
        <button @click="open = !open" class="lg:hidden p-2 text-white">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Menu lateral -->
        <aside :class="{'block': open, 'hidden': !open}" class="lg:block w-64 bg-gray-900 text-white min-h-screen p-4 shadow-md">
            <div class="flex flex-col items-center mb-6 text-center">
                <div>
                    <img src="{{ asset('images/icono-user.png') }}" alt="Icono User" class="mr flex items-center" style="width: 100px; height: 100px;">
                </div>
                <h3 class="text-lg font-semibold text-gray-300">BIENVENIDO</h3>
                <p class="text-xl font-bold">{{ Auth::user()->name }}</p>
            </div>

            <nav>
                <ul class="space-y-4 list-none">
                    <li><a href="{{ route('rh') }}" class="block py-2 px-4 rounded-lg text-gray-400 hover:bg-indigo-600 hover:text-white transition duration-300 flex items-center"><img src="{{ asset('images/icono-profile.png') }}" alt="Icono Perfil" class="w-7 h-7 mr-3">Perfil</a></li>
                    <li><a href="{{ route('reports.index') }}" class="block py-2 px-4 rounded-lg text-gray-400 hover:bg-indigo-600 hover:text-white transition duration-300 flex items-center"><img src="{{ asset('images/icono-reportes.png') }}" alt="Icono Reportes" class="w-7 h-7 mr-3">Reportes</a></li>
                    <li><a href="{{ route('refaccionamiento') }}" class="block py-2 px-4 rounded-lg text-gray-400 hover:bg-indigo-600 hover:text-white transition duration-300 flex items-center"><img src="{{ asset('images/icono-repair.png') }}" alt="Icono Reportes" class="w-7 h-7 mr-3">Refaccionamiento</a></li>
                    <li><a href="{{ route('history')}}" class="block py-2 px-4 rounded-lg text-gray-400 hover:bg-indigo-600 hover:text-white transition duration-300 flex items-center"><img src="{{ asset('images/icono-history.png') }}" alt="Icono Historial" class="w-7 h-7 mr-3">Historial</a></li>
                    <li><a href="{{ route('datosPostes.index')}}" class="block py-2 px-4 rounded-lg text-gray-400 hover:bg-indigo-600 hover:text-white transition duration-300 flex items-center"><img src="{{ asset('images/red-mark.png') }}" alt="Icono Camaras" class="w-7 h-7 mr-3">Listado</a></li>
                    <li><a href="{{route('popups.index')}}" class="block py-2 px-4 rounded-lg text-gray-400 hover:bg-indigo-600 hover:text-white transition duration-300 flex items-center"><img src="{{ asset('images/icono-cameras.png') }}" alt="Icono Notificaciones" class="w-7 h-7 mr-3">Camaras</a></li>
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

            <!-- Buscador de cámaras -->
            <div class="mt-6">
                <label for="cameraSearch" class="text-gray-400 block text-center mb-2">Búsqueda</label>
                <input type="text" id="cameraSearch" class="w-full px-4 py-2 bg-gray-800 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-300 text-center" placeholder="Buscar en mapa" onkeyup="searchCamera()" />
            </div>
        </aside>

        <!-- Contenido principal -->
        <div class="flex-1 p-6 w-full">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                    {{ __("Mapa Interactivo") }}
                </div>
            </div>

            <!-- Contenedor para el mapa -->
            <div class="flex justify-center items-start mt-8">
                <!-- Contenedor de estadísticas -->
                <div class="bg-gray-800 text-white rounded-lg shadow-lg p-4 mr-4 w-1/6">
                    <h3 class="text-sm font-bold">ESTADISTICAS</h3>
                    <p class="text-sm text-center"><strong>Atencion:</strong> {{ $pendingReportsCount }}</p>
                    <p class="text-sm text-center"><strong>Refacciones:</strong> {{ $refaccionamientoReportsCount }}</p>
                    <h3 class="text-sm font-bold">SIMBOLOGIA</h3>
                    <p class="text-sm text-center"><strong>Correcto   <img src="{{ asset('images/green-marker.png') }}" alt="Icono Reportes" class="w-7 h-7 mr-3"></strong>
                    <p class="text-sm text-center"><strong>Atencion  <img src="{{ asset('images/yellow-marker.png') }}" alt="Icono Reportes" class="w-7 h-7 mr-3"></strong>
                    <p class="text-sm text-center"><strong>Refaccion  <img src="{{ asset('images/red-marker.png') }}" alt="Icono Reportes" class="w-7 h-7 mr-3"></strong>
                </div>
                <!-- Contenedor del mapa -->
                <div class="bg-gray-800 rounded-lg shadow-lg w-full md:w-3/4 lg:w-3/5 h-80 sm:h-96">
                    <div id="map" class="w-full h-full rounded-lg"></div>
                </div>
            </div>

            <!-- Formularios -->
            <div class="flex justify-center mt-4 gap-20">
                <!-- Formulario para agregar cámaras -->
                <div class="bg-gray-800 rounded-lg shadow-lg w-full md:w-1/1 lg:w-1/3 h-auto sm:h-auto p-4">
                    <h3 class="text-white text-center mb-4 text-lg ">Agregar Cámara <img src="{{ asset('images/post-camera.png') }}" alt="Icono Cámara" class="w-6 h-6 mr-3"></h3>
                    <form method="POST" action="{{ route('cameras.store') }}" class="space-y-4">
                        @csrf
                        <div>
                            <label for="name" class="text-gray-400">Nombre de la cámara</label>
                            <input type="text" id="name" name="name" class="w-full px-4 py-2 bg-gray-700 text-white rounded-lg" required>
                        </div>
                        <div>
                            <label for="location" class="text-gray-400">Municipio</label>
                            <input type="text" id="location" name="location" class="w-full px-4 py-2 bg-gray-700 text-white rounded-lg" required>
                        </div>
                        <div>
                            <label for="latitude" class="text-gray-400">Latitud</label>
                            <input type="text" id="latitude" name="latitude" class="w-full px-4 py-2 bg-gray-700 text-white rounded-lg" required>
                        </div>
                        <div>
                            <label for="longitude" class="text-gray-400">Longitud</label>
                            <input type="text" id="longitude" name="longitude" class="w-full px-4 py-2 bg-gray-700 text-white rounded-lg" required>
                        </div>
                        <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition duration-300">Agregar Cámara</button>
                    </form>
                </div>

                <!-- Formulario para agregar reportes -->
                <div class="bg-gray-800 rounded-lg shadow-lg w-full md:w-1/1 lg:w-1/3 h-auto sm:h-auto p-6">
                    <h3 class="text-white text-center mb-6 text-lg ">Agregar Reporte <img src="{{ asset('images/post-report.png') }}" alt="Icono Reporte" class="w-6 h-6 mr-3"></h3>
                    <form method="POST" action="{{ route('reports.store') }}" class="space-y-5">
                        @csrf
                        <div>
                            <label for="camera_id" class="text-gray-400">Seleccionar Cámara</label>
                            <select id="camera_id" name="camera_id" class="w-full px-4 py-3 bg-white-700 text-gray rounded-lg focus:ring-indigo-600" required>
                                <option value="" disabled selected>Selecciona una cámara</option>
                                @foreach($cameras as $camera)
                                    <option value="{{ $camera->id }}">{{ $camera->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="description" class="text-gray-400">Descripción del problema</label>
                            <textarea id="description" name="description" class="w-full px-4 py-3 bg-white-700 text-gray rounded-lg focus:ring-indigo-600" rows="4" placeholder="Descripción detallada" required></textarea>
                        </div>
                        <div>
                            <label for="status" class="text-gray-400">Estatus</label>
                            <select id="status" name="status" class="w-full px-4 py-3 bg-white-700 text-gray rounded-lg focus:ring-indigo-600" required>
                                <option value="Pendiente">Pendiente</option>
                                <option value="Refaccionamiento">Refaccionamiento</option>
                            </select>
                        </div>
                        <div>
                            <label for="date" class="text-gray-400">Fecha</label>
                            <input type="date" id="date" name="date" class="w-full px-4 py-3 bg-gray-700 text-white rounded-lg focus:ring-indigo-600" required>
                        </div>
                        <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition duration-300">Registrar Reporte</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Leaflet CSS y JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Script para inicializar el mapa -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var map = L.map('map').setView([19.3133, -98.2400], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var markers = [];
            @foreach ($cameras as $camera)
                @php
                    $report = $camera->reports->where('status', 'Pendiente')->first();
                    $refaccionamientoReport = $camera->reports->firstWhere('status', 'Refaccionamiento');
                @endphp
                var marker = L.marker([{{ $camera->latitude }}, {{ $camera->longitude }}], {
                    icon: L.icon({
                        iconUrl: '{{ $report ? asset('images/yellow-marker.png') : ($refaccionamientoReport ? asset('images/red-marker.png') : asset('images/green-marker.png')) }}',
                        iconSize: [40, 40],
                        iconAnchor: [12, 12],
                        popupAnchor: [0, -10]
                    })
                }).addTo(map)
                .bindPopup(`
                    <strong>{{ $camera->name }}</strong><br/>
                    @if($report)
                        <span class="text-red-500">Atencion</span><br/>
                        <strong>Descripción:</strong> {{ Str::limit($report->description, 100) }}<br/>
                        <strong>Fecha del Reporte:</strong> {{ \Carbon\Carbon::parse($report->date)->format('d/m/Y') }}<br/>
                    @elseif($refaccionamientoReport)
                        <span class="text-yellow-500">Espera Refacciónnamiento</span><br/>
                        <strong>Descripción:</strong> {{ Str::limit($refaccionamientoReport->description, 100) }}<br/>
                        <strong>Fecha del Reporte:</strong> {{ \Carbon\Carbon::parse($refaccionamientoReport->date)->format('d/m/Y') }}<br/>
                    @else
                        <span class="text-green-500">Sin Reportes Pendientes</span>
                    @endif
                `);

                markers.push(marker);
            @endforeach

            window.searchCamera = function () {
                var searchTerm = document.getElementById("cameraSearch").value.toLowerCase();
                var matchingMarker = markers.find(function (marker) {
                    return marker.getPopup().getContent().toLowerCase().includes(searchTerm);
                });

                if (matchingMarker) {
                    map.setView(matchingMarker.getLatLng(), 15);
                    matchingMarker.openPopup();
                } else {
                    Swal.fire({
                        title: "Sin resultados",
                        text: "No se encontraron cámaras que coincidan con la búsqueda.",
                        icon: "warning",
                        confirmButtonText: "Aceptar",
                    });
                }
            }
        });
    </script>
    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '¡Éxito!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
        });
    </script>
    @endif
    
</x-app-layout>

