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
                <div><img src="{{ asset('images/icono-pages1.png') }}" alt="Icono User" class="mr flex items-center" style="width: 150px; height: 150px;"></i></div> 
                <h3 class="text-lg font-semibold text-gray-300">Perfil</h3>
                
            </div>

            <nav>
                <ul class="space-y-4 list-none">
                    <li><a href="{{ route('reports.index') }}" class="block py-2 px-4 rounded-lg text-gray-400 hover:bg-indigo-600 hover:text-white transition duration-300 flex items-center"><img src="{{ asset('images/icono-reportes.png') }}" alt="Icono Reportes" class="w-7 h-7 mr-3">Reportes</a></li>
                    <li><a href="{{ route('history')}}" class="block py-2 px-4 rounded-lg text-gray-400 hover:bg-indigo-600 hover:text-white transition duration-300 flex items-center"><img src="{{ asset('images/icono-history.png') }}" alt="Icono Historial" class="w-7 h-7 mr-3">Historial</a></li>
                    <li><a href="{{ route('datosPostes.index')}}" class="block py-2 px-4 rounded-lg text-gray-400 hover:bg-indigo-600 hover:text-white transition duration-300 flex items-center"><img src="{{ asset('images/icono-cameras.png') }}" alt="Icono Camaras" class="w-7 h-7 mr-3">Camaras</a></li>
                    <a href="{{ route('dashboard')}}" class="block py-2 px-4 rounded-lg text-gray-400 hover:bg-indigo-600 hover:text-white transition duration-300 flex items-center"><img src="{{ asset('images/icono-home.png') }}" alt="Icono home" class="w-7 h-7 mr-3">Home</a></li>        
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
            
       <!-- Final de la barra lateral -->
            
        </aside>

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
