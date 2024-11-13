<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reportes') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h3 class="text-xl font-semibold mb-4">Reportes de Cámaras</h3>
                
                @if(isset($noReportsMessage))
                    <p class="text-gray-500">{{ $noReportsMessage }}</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($reports as $report)
                            <div class="bg-gray-700 rounded-lg shadow-lg p-4">
                                <h4 class="text-lg font-bold text-white">{{ $report->camera->name }}</h4>
                                <p class="text-gray-300 mt-2"><strong>Descripción:</strong> {{ $report->description }}</p>
                                <p class="text-gray-300 mt-2"><strong>Estatus:</strong> {{ $report->status }}</p>
                                <p class="text-gray-300 mt-2"><strong>Fecha de reporte:</strong> {{ $report->date }}</p>

                                <form method="POST" action="{{ route('reports.updateStatus', $report->id) }}" class="mt-3">
                                    @csrf
                                    @method('POST')
                                    <div class="flex items-center space-x-2">
                                        <select name="status" class="bg-white-800 text-gray rounded-lg px-3 py-2">
                                            <option value="pendiente" {{ $report->status == 'pendiente' ? 'selected' : '' }} style="color: gray;">Pendiente</option>
                                            <option value="solucionado" {{ $report->status == 'solucionado' ? 'selected' : '' }} style="color: gray;">Solucionado</option>
                                        </select>
                                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition duration-300">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
