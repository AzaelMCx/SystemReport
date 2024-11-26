<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Datos de los Postes') }}
        </h2>
    </x-slot>

    <!-- Mostrar mensaje de éxito -->
    @if(session('success'))
        <div id="successMessage" class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg">
            {{ session('success') }}
        </div>

        <script>
            // Desaparecer el mensaje después de 2 segundos
            setTimeout(function() {
                document.getElementById('successMessage').style.display = 'none';
            }, 2000);
        </script>
    @endif

    <div class="flex justify-center items-center mt-8">
        <div class="w-full max-w-7xl mx-auto bg-gray-800 p-6 rounded-lg shadow-lg">
            <h3 class="text-white text-lg font-semibold mb-4">Lista de Datos de Postes</h3>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse bg-gray-300 text-gray rounded-lg">
                    <thead>
                        <tr class="bg-gray-700 text-left text-sm uppercase">
                            <th class="p-3 border-b border-gray-700">id</th>
                            <th class="p-3 border-b border-gray-700">Nombre</th>
                            <th class="p-3 border-b border-gray-700">Ubicación</th>
                            <th class="p-3 border-b border-gray-700">Marca</th>
                            <th class="p-3 border-b border-gray-700">Modelo</th>
                            <th class="p-3 border-b border-gray-700">IP</th>
                            <th class="p-3 border-b border-gray-700">Gateway</th>
                            <th class="p-3 border-b border-gray-700 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datosPostes as $poste)
                            <tr class="hover:bg-white-800 transition duration-200">
                                <td class="p-3 border-b border-gray-700">{{ $loop->iteration }}</td>
                                <td class="p-3 border-b border-gray-700">{{ $poste->NameCamera }}</td>
                                <td class="p-3 border-b border-gray-700">{{ $poste->location }}</td>
                                <td class="p-3 border-b border-gray-700">{{ $poste->Brand }}</td>
                                <td class="p-3 border-b border-gray-700">{{ $poste->Model }}</td>
                                <td class="p-3 border-b border-gray-700">{{ $poste->IP }}</td>
                                <td class="p-3 border-b border-gray-700">{{ $poste->Gateway }}</td>
                                <td class="p-3 border-b border-gray-700 text-center">
                                    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md transform hover:scale-105 transition duration-300" onclick="openEditModal({{ json_encode($poste) }})">Editar</button>
                                    <form action="{{ route('datosPostes.destroy', $poste->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg shadow-md transform hover:scale-105 transition duration-300" onclick="return confirm('¿Estás seguro de eliminar este registro?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="p-3 text-center text-gray-400">No hay datos disponibles.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal para editar datos del poste -->
    <div id="editModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h3 class="text-lg font-semibold mb-4">Editar Datos del Poste</h3>
            <form id="editForm" action="{{ route('datosPostes.update', 0) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="NameCamera" class="block text-gray-700">Nombre</label>
                    <input type="text" id="NameCamera" name="NameCamera" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="location" class="block text-gray-700">Ubicación</label>
                    <input type="text" id="location" name="location" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="Brand" class="block text-gray-700">Marca</label>
                    <input type="text" id="Brand" name="Brand" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="Model" class="block text-gray-700">Modelo</label>
                    <input type="text" id="Model" name="Model" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="IP" class="block text-gray-700">IP</label>
                    <input type="text" id="IP" name="IP" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="Gateway" class="block text-gray-700">Gateway</label>
                    <input type="text" id="Gateway" name="Gateway" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded" onclick="closeEditModal()">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Función para abrir el modal con los datos del poste a editar
        function openEditModal(poste) {
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('NameCamera').value = poste.NameCamera;
            document.getElementById('location').value = poste.location;
            document.getElementById('Brand').value = poste.Brand;
            document.getElementById('Model').value = poste.Model;
            document.getElementById('IP').value = poste.IP;
            document.getElementById('Gateway').value = poste.Gateway;

            // Cambiar la acción del formulario al ID correspondiente
            const form = document.getElementById('editForm');
            form.action = '/datosPostes/' + poste.id;
        }

        // Función para cerrar el modal
        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>
</x-app-layout>

