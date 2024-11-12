<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reportes') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h3 class="text-xl font-semibold">Bienvenido a la página de Reportes</h3>
                <p>Aquí podrás gestionar y visualizar los reportes del sistema.</p>
            </div>
        </div>
    </div>
</x-app-layout>
