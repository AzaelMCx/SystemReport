<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Historial') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <!-- Contenedor adaptativo -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h3 class="text-lg font-semibold text-center mb-4">Historial de Reportes</h3>

                <!-- Comprobamos si existen cámaras con reportes solucionados -->
                @if($cameras->isEmpty())
                    <p class="text-gray-400 text-center">No hay cámaras con reportes solucionados.</p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($cameras as $camera)
                            <!-- Verificar si la cámara tiene reportes solucionados -->
                            @if($camera->reports->isNotEmpty())
                                <div class="bg-gray-700 p-4 rounded-lg shadow-lg">
                                    <h4 class="text-xl font-bold text-gray-300 text-center mb-4">{{ $camera->name }}</h4>

                                    @foreach($camera->reports as $report)
                                        <!-- Mostrar solo reportes con estado 'solucionado' -->
                                        @if($report->status == 'solucionado')
                                            <div class="bg-gray-800 rounded-lg shadow-md p-4 mb-3"> <img src="{{ asset('images/icon-history.png') }}" alt="DataHistory" class="w-10 h-10 mr-3 flex items-center">
                                                <p class="text-gray-300"><strong>Problema:</strong> {{ $report->description }}</p>
                                                <p class="text-gray-300"><strong>Fecha de reporte:</strong> {{ $report->date }}</p>
                                                <p class="text-gray-300"><strong>Estatus:</strong> {{ $report->status }}</p>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        @endforeach
                    </div
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
