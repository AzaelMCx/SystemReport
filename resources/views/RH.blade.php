<x-app-layout> 
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Recursos Humanos') }}
        </h2>
    </x-slot>

    <div class="flex justify-center items-start mt-8">
        <!-- Contenedor principal para alinear los dos contenedores -->
        <div class="w-full max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <!-- Primer contenedor: Información del Usuario con estilo tipo credencial -->
            <div class="bg-gradient-to-br from-gray-100 to-gray-300 p-6 rounded-xl shadow-2xl transform hover:scale-105 transition-all">
                <div class="flex justify-center mb-4">
                    <!-- Imagen del Usuario -->
                    <img src="{{ asset('images/default-user.png') }}" alt="Imagen de Usuario" class="w-24 h-24 rounded-full border-4 border-gray-200 shadow-lg object-cover">
                </div>

                <div class="text-center">
                    <h3 class="text-2xl font-semibold text-gray-700 shadow-md">{{ $user->name }}</h3>
                    <p class="text-lg text-gray-500">{{ $user->email }}</p>
                    <p class="text-lg text-gray-500">{{ $user->rol }}</p>
                    <p class="text-lg text-gray-500">{{ $user->sexo }}</p>
                    <p class="text-lg text-gray-500">{{ $user->departamento }}</p>
                </div>
            </div>

            <!-- Segundo contenedor: Dejado libre para más adelante -->
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                <h3 class="text-white text-lg font-semibold mb-4">Contenedor 2</h3>
                <p class="text-white">Este es el segundo contenedor. Puedes añadir contenido aquí más adelante según sea necesario.</p>
            </div>

        </div>
    </div>
</x-app-layout>
