<script setup>
import { Head, Link } from '@inertiajs/vue3';
//import { Ship, Package, Users, Search, BarChart3 } from 'lucide-vue-next'

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

  <Head title="welcome" />
  <div class="min-h-screen bg-gray-50">

    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <div class="flex items-center">
            <div class="flex-shrink-0 flex items-center">
              <!--<Ship class="h-8 w-8 text-blue-600" />-->
              <span class="ml-2 text-xl font-semibold text-gray-900">Minucia App</span>
            </div>
          </div>
          <div v-if="canLogin" class=" z-10 sm:top-0 sm:right-0 p-4 text-end">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')"
              class="ml-2 text-xl font-semibold text-blue-600">
            Dashboard</Link>
            <template v-else>
              <div class="flex items-center space-x-4">
                <Link :href="route('login')" class="text-gray-500 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">
                  Iniciar Sesión
                </Link>
                <Link v-if="canRegister" :href="route('register')"
                  class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                  Registrarse
                </Link>
              </div>
            </template>
          </div>
        </div>
      </div>
    </nav>

    <!-- Hero Section with Ship Image -->
    <div class="relative bg-white overflow-hidden">
      <div class="max-w-7xl mx-auto">
        <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
          <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2"
            fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
            <polygon points="50,0 100,0 50,100 0,100" />
          </svg>

          <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
            <div class="sm:text-center lg:text-left">
              <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                <span class="block xl:inline">Registro de Piezas</span>
                <span class="block text-blue-600 xl:inline">Navales y Fluviales</span>
              </h1>
              <p
                class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                Gestiona y registra todas las piezas de tu flota naval de manera eficiente.
                Control de inventario, bloques, proyectos y especificaciones técnicas en una sola plataforma.
              </p>
              <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                <div class="rounded-md shadow">
                  <button
                    class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 md:py-4 md:text-lg md:px-10 transition duration-150 ease-in-out">
                    Comenzar Ahora
                  </button>
                </div>
                <div class="mt-3 sm:mt-0 sm:ml-3">
                  <button
                    class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 md:py-4 md:text-lg md:px-10 transition duration-150 ease-in-out">
                    Ver Demo
                  </button>
                </div>
              </div>
            </div>
          </main>
        </div>
      </div>
      <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
        <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full"
          src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-2RLh0dI7J7MxOCqXuOqanz6liqfFH9.png"
          alt="Construcción naval">
      </div>
    </div>

    <!-- Features Section -->
    <div class="py-12 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:text-center">
          <h2 class="text-base text-blue-600 font-semibold tracking-wide uppercase">Características</h2>
          <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
            Todo lo que necesitas para gestionar tu inventario naval
          </p>
          <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
            Una solución completa para el registro y control de piezas navales y fluviales.
          </p>
        </div>

        <div class="mt-10">
          <div class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
            <div class="relative">
              <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
                <!--<Package class="h-6 w-6" />-->
              </div>
              <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Registro Detallado</p>
              <p class="mt-2 ml-16 text-base text-gray-500">
                Registra cada pieza con información completa: nombre, código, marca, bloques, cantidad y precio.
              </p>
            </div>

            <div class="relative">
              <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
                <!--<Users class="h-6 w-6" />-->
              </div>
              <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Gestión de Proveedores</p>
              <p class="mt-2 ml-16 text-base text-gray-500">
                Mantén un registro organizado de todos tus proveedores y sus especialidades.
              </p>
            </div>

            <div class="relative">
              <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
                <!--<Search class="h-6 w-6" />-->
              </div>
              <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Búsqueda Avanzada</p>
              <p class="mt-2 ml-16 text-base text-gray-500">
                Encuentra rápidamente cualquier pieza usando filtros por marca, código o proveedor.
              </p>
            </div>

            <div class="relative">
              <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
                <!--<BarChart3 class="h-6 w-6" />-->
              </div>
              <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Reportes y Analytics</p>
              <p class="mt-2 ml-16 text-base text-gray-500">
                Genera reportes detallados sobre tu inventario y costos de mantenimiento.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-blue-50">
      <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
        <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
          <span class="block">¿Listo para optimizar tu inventario?</span>
          <span class="block text-blue-600">Comienza hoy mismo.</span>
        </h2>
        <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
          <div class="inline-flex rounded-md shadow">
            <button
              class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition duration-150 ease-in-out">
              Registrarse Gratis
            </button>
          </div>
          <div class="ml-3 inline-flex rounded-md shadow">
            <button
              class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-gray-50 transition duration-150 ease-in-out">
              Contactar Ventas
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white">
      <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
        <div class="flex justify-center space-x-6 md:order-2">
          <a href="#" class="text-gray-400 hover:text-gray-500">
            <span class="sr-only">Facebook</span>
            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
              <path fill-rule="evenodd"
                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                clip-rule="evenodd" />
            </svg>
          </a>
          <a href="#" class="text-gray-400 hover:text-gray-500">
            <span class="sr-only">Twitter</span>
            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
              <path
                d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
            </svg>
          </a>
        </div>
        <div class="mt-8 md:mt-0 md:order-1">
          <p class="text-center text-base text-gray-400">
            &copy; 2024 Minucia App. Todos los derechos reservados.
          </p>
        </div>
      </div>
    </footer>
  </div>
</template>
