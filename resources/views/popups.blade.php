<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestión de Cámaras') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="mb-4">
            <!-- Botón para regresar al dashboard -->
            <a href="{{ route('dashboard') }}" 
               class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-bold py-2 px-4 rounded transition duration-300">
                Home
            </a>
        </div>

        <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-900">
                <h3 class="text-lg font-semibold mb-4">Lista de Cámaras</h3>

                <style>
                    table {
                        width: 100%;
                        border-collapse: collapse;
                        background-color: #f8fafc; /* Fondo gris claro */
                        border: 1px solid #e5e7eb; /* Bordes */
                        border-radius: 8px;
                        overflow: hidden;
                    }

                    thead {
                        background-color: #4f46e5; /* Fondo morado */
                        color: white; /* Texto blanco */
                    }

                    th, td {
                        padding: 14px 20px;
                        text-align: left;
                        border-bottom: 1px solid #e5e7eb; /* Línea divisoria */
                    }

                    tbody tr:last-child td {
                        border-bottom: none; /* Sin borde para la última fila */
                    }

                    tbody tr:hover {
                        background-color: #e5e7eb; /* Fondo gris más claro al pasar el mouse */
                        cursor: pointer;
                    }

                    .action-buttons button {
                        margin-right: 5px;
                    }

                    .action-buttons button:last-child {
                        margin-right: 0;
                    }
                </style>

                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Ubicación</th>
                            <th>Latitud</th>
                            <th>Longitud</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cameras as $camera)
                            <tr>
                                <td>{{ $camera->name }}</td>
                                <td>{{ $camera->location }}</td>
                                <td>{{ $camera->latitude }}</td>
                                <td>{{ $camera->longitude }}</td>
                                <td class="action-buttons">
                                    <!-- Botón para abrir el modal -->
                                    <button onclick="openEditModal({{ $camera->id }}, '{{ $camera->name }}', '{{ $camera->location }}', '{{ $camera->latitude }}', '{{ $camera->longitude }}')" 
                                            class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold py-1 px-3 rounded">
                                        Editar
                                    </button>
                                    <form action="{{ route('cameras.destroy', $camera->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm font-bold py-1 px-3 rounded">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal para editar -->
    <div id="editModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-60 flex items-center justify-center z-50">
        <div class="bg-gray-100 dark:bg-gray-800 rounded-lg shadow-lg p-6 w-10/12 sm:w-2/3 lg:w-1/3">
            <button onclick="closeEditModal()" class="text-gray-600 dark:text-gray-400 float-right">
                &#x2715;
            </button>
            <h4 class="text-lg font-semibold text-center text-gray-900 dark:text-gray-200 mb-4">Editar Cámara</h4>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="editName" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Nombre</label>
                    <input type="text" id="editName" name="name" class="mt-1 block w-full rounded-md bg-gray-700 text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                </div>
                <div class="mb-4">
                    <label for="editLocation" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Ubicación</label>
                    <input type="text" id="editLocation" name="location" class="mt-1 block w-full rounded-md bg-gray-700 text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <label for="editLatitude" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Latitud</label>
                    <input type="number" step="any" id="editLatitude" name="latitude" class="mt-1 block w-full rounded-md bg-gray-700 text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                </div>
                <div class="mb-4">
                    <label for="editLongitude" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Longitud</label>
                    <input type="number" step="any" id="editLongitude" name="longitude" class="mt-1 block w-full rounded-md bg-gray-700 text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, name, location, latitude, longitude) {
            document.getElementById('editForm').action = `/cameras/${id}`;
            document.getElementById('editName').value = name;
            document.getElementById('editLocation').value = location;
            document.getElementById('editLatitude').value = latitude;
            document.getElementById('editLongitude').value = longitude;

            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
