<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sistema') }}
        </h2>
    </x-slot>

    <div x-data="{ open: false }" class="flex">
        <!-- Botón para abrir el menú en pantallas pequeñas -->
        <button @click="open = !open" class="lg:hidden p-2 text-white">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Menu lateral -->
        <aside :class="{'block': open, 'hidden': !open}" class="lg:block w-64 bg-gray-900 text-white min-h-screen p-4 shadow-md">
            <div class="flex flex-col items-center mb-6">
                <div><i class="fas fa-user-circle text-white fa-3x"></i></div>
                <h3 class="text-lg font-semibold text-gray-300">Bienvenido</h3>
                <p class="text-xl font-bold">{{ Auth::user()->name }}</p>
            </div>

            <nav>
                <ul class="space-y-4 list-none">
                    <li><a href="{{ route('reports.index') }}" class="block py-2 px-4 rounded-lg text-gray-400 hover:bg-indigo-600 hover:text-white transition duration-300"><i class="fas fa-chart-line mr-3"></i> Reportes</a></li>
                    <li><a href="#" class="block py-2 px-4 rounded-lg text-gray-400 hover:bg-indigo-600 hover:text-white transition duration-300"><i class="fas fa-video mr-3"></i> Camaras</a></li>
                    <li><a href="#" class="block py-2 px-4 rounded-lg text-gray-400 hover:bg-indigo-600 hover:text-white transition duration-300"><i class="fas fa-question-circle mr-3"></i> Ayuda</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block py-2 px-4 rounded-lg w-full text-left text-gray-400 hover:bg-red-600 hover:text-white transition duration-300">
                                <i class="fas fa-sign-out-alt mr-3"></i> Cerrar sesión
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
            
       <!-- busacador de cámaras -->
            <div class="mt-6">
                <label for="cameraSearch" class="text-gray-400 block text-center mb-2">Buscar Cámara</label>
                <input type="text" id="cameraSearch" class="w-full px-4 py-2 bg-gray-800 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-300" placeholder="Buscar Cámara" onkeyup="searchCamera()" />
            </div>
            
        </aside>

        <!-- Contenido principal -->
        <div class="flex-1 p-6 w-full">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Mapa") }}
                </div>
            </div>

            <!-- Contenedor para el mapa -->
            <div class="flex justify-center items-center mt-8">
                <div class="bg-gray-800 rounded-lg shadow-lg w-full md:w-3/4 lg:w-3/5 h-80 sm:h-96">
                    <div id="map" class="w-full h-full rounded-lg"></div>
                </div>
            </div>

            <!-- Otros contenedores (formulario de cámaras y reportes) -->
            <div class="flex justify-center mt-4 gap-40">
                <!-- Primer contenedor con formulario -->
                <div class="bg-gray-800 rounded-lg shadow-lg w-full md:w-1/1 lg:w-1/3 h-auto sm:h-auto p-4">
                    <h3 class="text-white text-center mb-4 text-lg ">Agregar Cámara</h3>
                    <form method="POST" action="{{ route('cameras.store') }}" class="space-y-4">
                        @csrf
                        <div>
                            <label for="name" class="text-gray-400">Nombre de la cámara</label>
                            <input type="text" id="name" name="name" class="w-full px-4 py-2 bg-gray-700 text-white rounded-lg" required>
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

                <!-- Segundo contenedor con formulario de reportes  -->
                <div class="bg-gray-800 rounded-lg shadow-lg w-full md:w-1/1 lg:w-1/3 h-auto sm:h-auto p-6">
                    <h3 class="text-white text-center mb-6 text-lg ">Agregar Reporte</h3>
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
                            <input type="text" id="status" name="status" class="w-full px-4 py-3 bg-gray-700 text-white rounded-lg focus:ring-indigo-600" value="Pendiente" readonly>
                        </div>

                        <div>
                            <label for="date" class="text-gray-400">Fecha</label>
                            <input type="date" id="date" name="date" class="w-full px-4 py-3 bg-gray-700 text-white rounded-lg focus:ring-indigo-600" required>
                        </div>

                        <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition duration-300">
                            Registrar Reporte
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Agregar Leaflet CSS y JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <!-- Script para inicializar el mapa -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var map = L.map('map').setView([19.3133, -98.2400], 13); // Coordenadas de Tlaxcala, México

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var markers = [];
            // Añadir los marcadores de cámaras al mapa
            @foreach ($cameras as $camera)
                @php
                    $report = $camera->reports->where('status', 'Pendiente')->first();
                @endphp
                var marker = L.marker([{{ $camera->latitude }}, {{ $camera->longitude }}], {
                    icon: L.icon({
                        iconUrl: '{{ $report ? asset('images/red-marker.png') : asset('images/green-marker.png') }}', // Dependiendo del reporte
                        iconSize: [29, 29],
                        iconAnchor: [12, 12],
                        popupAnchor: [0, -10]
                    })
                })
                .addTo(map)
                .bindPopup('{{ $camera->name }}');
                
                markers.push(marker);
            @endforeach

            // Función para filtrar cámaras por nombre y centrar el mapa
            window.searchCamera = function() {
                var searchTerm = document.getElementById("cameraSearch").value.toLowerCase();
                var found = false;
                markers.forEach(function(marker) {
                    var cameraName = marker.getPopup().getContent().toLowerCase();
                    if (cameraName.includes(searchTerm)) {
                        marker.addTo(map);
                        marker.openPopup(); // Mostrar el nombre de la cámara
                        map.setView(marker.getLatLng(), 15); // Centrar el mapa en la cámara encontrada
                        found = true;
                    } 
                });
                if (!found) {
                    alert('Cámara no encontrada');
                }
            }
        });
    </script>
</x-app-layout>
