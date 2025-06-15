<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Welcome" />

    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white"
    >
        <div v-if="canLogin" class="sm:fixed z-10 sm:top-0 sm:right-0 p-6 text-end">
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                >Dashboard</Link
            >

            <template v-else>
                <Link
                    :href="route('login')"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    >Iniciar Sesión</Link
                >

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    >Registrar</Link
                >
            </template>
        </div>

         <div class="max-w-7xl opacity-40 mx-auto p-6 lg:p-8 h-screen flex flex-col justify-center items-center bg-gradient-to-br from-gray-900 via-indigo-900 to-purple-900 relative overflow-hidden">
    <!-- Fondo RGB animado -->
    <div class="absolute inset-0 pointer-events-none z-0">
      <div class="w-full h-full opacity-40 animate-pulse"
           style="background: radial-gradient(circle at 20% 30%, #00fff7 0%, transparent 7%), 
                          radial-gradient(circle at 80% 70%, #ff00ea 0%, transparent 7%), 
                          radial-gradient(circle at 50% 90%, #00ff85 0%, transparent 7%);">
      </div>
    </div>
    <!-- Contenido principal -->
    <div class="relative z-10 text-center">
      <h1 class="text-4xl lg:text-6xl font-extrabold text-white drop-shadow-lg mb-4">
        <span class="bg-gradient-to-r from-cyan-400 via-pink-400 to-green-400 bg-clip-text text-transparent">
          Compomentes y Piezas para todo tipo de computadoras.
        </span>
      </h1>
      <p class="text-lg lg:text-2xl text-white font-bold mb-8">
        lorem ipsum dolor sit amet, consectetur adipiscing elit.
        lorem ipsum dolor sit amet, consectetur adipiscing elit.
        lorem ipsum dolor sit amet, consectetur adipiscing elit.
        <br>
        Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.      
      </p>
      <div class="flex flex-wrap justify-center gap-6">
        <div class="bg-gray-800 bg-opacity-80 rounded-xl p-6 shadow-lg flex flex-col items-center hover:scale-105 transition">
          <svg class="w-12 h-12 mb-2 text-cyan-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <rect x="3" y="7" width="18" height="13" rx="2" />
            <path d="M8 7V5a4 4 0 0 1 8 0v2" />
          </svg>
          <span class="text-white font-semibold">Procesadores</span>
        </div>
        <div class="bg-gray-800 bg-opacity-80 rounded-xl p-6 shadow-lg flex flex-col items-center hover:scale-105 transition">
          <svg class="w-12 h-12 mb-2 text-pink-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <rect x="2" y="6" width="20" height="12" rx="2" />
            <path d="M6 18v2" />
            <path d="M18 18v2" />
          </svg>
          <span class="text-white font-semibold">Tarjetas Gráficas</span>
        </div>
        <div class="bg-gray-800 bg-opacity-80 rounded-xl p-6 shadow-lg flex flex-col items-center hover:scale-105 transition">
          <svg class="w-12 h-12 mb-2 text-green-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <rect x="4" y="4" width="16" height="16" rx="2" />
            <path d="M8 16h8" />
            <path d="M8 12h8" />
            <path d="M8 8h8" />
          </svg>
          <span class="text-white font-semibold">Memorias RGB</span>
        </div>
      </div>
    </div>
  </div>
      
    </div>
    
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
