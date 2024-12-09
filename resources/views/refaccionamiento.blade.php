<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Refaccionamiento') }}
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
                    <img src="{{ asset('images/icono-pages.png') }}" alt="Icono User" class="w-36 h-36 rounded-full">
                </div> 
                <h3 class="text-lg font-semibold text-gray-300 mt-4">Lista de Refaccionamientos</h3>
            </div>

            <nav>
                <ul class="space-y-4 list-none">
                    <li>
                        <a href="{{ route('history') }}" class="block py-2 px-4 rounded-lg text-gray-400 hover:bg-indigo-600 hover:text-white transition duration-300 flex items-center">
                            <img src="{{ asset('images/icono-history.png') }}" alt="Icono Historial" class="w-7 h-7 mr-3">Historial
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('datosPostes.index') }}" class="block py-2 px-4 rounded-lg text-gray-400 hover:bg-indigo-600 hover:text-white transition duration-300 flex items-center">
                            <img src="{{ asset('images/icono-cameras.png') }}" alt="Icono Camaras" class="w-7 h-7 mr-3">Cámaras
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard') }}" class="block py-2 px-4 rounded-lg text-gray-400 hover:bg-indigo-600 hover:text-white transition duration-300 flex items-center">
                            <img src="{{ asset('images/icono-home.png') }}" alt="Icono Home" class="w-7 h-7 mr-3">Home
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block py-2 px-4 rounded-lg w-full text-left text-gray-400 hover:bg-red-600 hover:text-white transition duration-300 flex items-center">
                                <img src="{{ asset('images/icono-logout.png') }}" alt="Icono Logout" class="w-7 h-7 mr-3"> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Contenido principal -->
        <div class="flex-1 p-6 text-gray-900 dark:text-gray-100">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <p class="text-center text-gray-500">Vista de refaccionamiento lista para añadir elementos en el futuro.</p>
            </div>
        </div>
    </div>
</x-app-layout>

