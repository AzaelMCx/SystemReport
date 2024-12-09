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
                <h3 class="text-lg font-semibold text-gray-300">Historial</h3>
            </div>

            <nav>
                <ul class="space-y-4 list-none">
                    <li><a href="{{ route('reports.index') }}" class="block py-2 px-4 rounded-lg text-gray-400 hover:bg-indigo-600 hover:text-white transition duration-300 flex items-center"><img src="{{ asset('images/icono-reportes.png') }}" alt="Icono Reportes" class="w-7 h-7 mr-3">Reportes</a></li>
                    <li><a href="{{ route('datosPostes.index')}}" class="block py-2 px-4 rounded-lg text-gray-400 hover:bg-indigo-600 hover:text-white transition duration-300 flex items-center"><img src="{{ asset('images/icono-cameras.png') }}" alt="Icono Camaras" class="w-7 h-7 mr-3">Camaras</a></li>
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
            <!-- Contenedor adaptativo -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold text-center mb-4">Historial de Reportes</h3>

                    <!-- Barra de búsqueda centrada -->
                    <div class="flex justify-center mb-6">
                        <input type="text" id="searchCamera" class="w-1/2 sm:w-1/3 px-4 py-2 bg-gray-700 text-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-300" placeholder="Buscar cámara por nombre..." oninput="searchCamera()">
                    </div>

                    <!-- Comprobamos si existen cámaras con reportes solucionados -->
                    @if($cameras->isEmpty())
                        <p class="text-gray-400 text-center">No hay cámaras con reportes solucionados.</p>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($cameras as $camera)
                                @if($camera->reports->isNotEmpty())
                                    <div class="bg-gray-700 p-4 rounded-lg shadow-lg">
                                        <h4 class="text-xl font-bold text-gray-300 text-center mb-4">{{ $camera->name }}</h4>
                                        
                                        @foreach($camera->reports as $report)
                                            @if($report->status == 'solucionado')
                                                <div class="bg-gray-800 rounded-lg shadow-md p-4 mb-3"> 
                                                    <img src="{{ asset('images/icon-history.png') }}" alt="DataHistory" class="w-10 h-10 mr-3 flex items-center">
                                                    <p class="text-gray-300"><strong>Problema:</strong> {{ $report->description }}</p>
                                                    <p class="text-gray-300"><strong>Fecha de reporte:</strong> {{ $report->date }}</p>
                                                    <p class="text-gray-300"><strong>Fecha de atencion:</strong> {{ $report->updated_at }}</p>
                                                    <p class="text-gray-300"><strong>Estatus:</strong> {{ $report->status }}</p>
                                                    <!-- Mostrar la solución si está disponible -->
                                                    @if($report->solutions)
                                                        <p class="text-gray-300"><strong>Solución:</strong> {{ $report->solutions }}</p>
                                                    @endif
                                                         
                                                </div>
                                            @endif
                                        @endforeach

                                        <a href="{{ route('cameras.downloadReports', $camera->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded block text-center">
                                            Descargar PDF
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="searchModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-60 flex items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-10/12 sm:w-2/3 lg:w-1/3">
            <button onclick="closeModal()" class="text-gray-600 dark:text-gray-400 float-right">
                &#x2715;
            </button>
            <h4 class="text-lg font-semibold text-center text-gray-800 dark:text-gray-200 mb-4">Resultados de la búsqueda</h4>
            <div id="modalContent" class="space-y-4">
                <!-- Los resultados de la búsqueda se cargarán aquí dinámicamente -->
            </div>
            <div class="flex justify-center mt-4">
                <button onclick="closeModal()" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    Cerrar
                </button>
            </div>
        </div>
    </div>

    <script>
        const cameras = @json($cameras);
        let closeModalTimeout;

        function searchCamera() {
            const query = document.getElementById('searchCamera').value.toLowerCase();
            
            // Reinicia el temporizador al escribir
            clearTimeout(closeModalTimeout);

            if (query.trim() === "") {
                closeModalTimeout = setTimeout(() => {
                    closeModal();
                }, 1000);
                return;
            }

            const results = cameras.filter(camera => 
                camera.name.toLowerCase().includes(query) && camera.reports.some(report => report.status === 'solucionado')
            );

            if (results.length > 0) {
                const modalContent = document.getElementById('modalContent');
                modalContent.innerHTML = results.map(camera => `
                    <div class="bg-gray-700 p-4 rounded-lg shadow-md">
                        <h4 class="text-lg font-semibold text-gray-300">${camera.name}</h4>
                        <p class="text-gray-400">Reportes solucionados: ${camera.reports.filter(r => r.status === 'solucionado').length}</p>
                        <a href="/cameras/${camera.id}/download-reports" class="mt-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded block text-center">
                            Descargar PDF
                        </a>
                    </div>
                `).join('');
                openModal();
            } else {
                closeModal();
            }
        }

        function openModal() {
            document.getElementById('searchModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('searchModal').classList.add('hidden');
        }
    </script>
</x-app-layout>

