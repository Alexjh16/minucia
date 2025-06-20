<script setup>

import EditIcon from '@/Components/Icons/EditIcon.vue';
import RemoveIcon from '@/Components/Icons/RemoveIcon.vue';
import Pagination from '@/Components/Icons/Pagination.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';


//definir las propiedades que se recibirán desde Laravel
const props = defineProps({
    piezas: Object
});

function formatFecha(fecha) {
    if (!fecha) return '';
    const d = new Date(fecha);
    const dia = String(d.getDate()).padStart(2, '0');
    const mes = String(d.getMonth() + 1).padStart(2, '0');
    const anio = d.getFullYear();
    return `${dia}/${mes}/${anio}`;
}

const destroyPieza = async (id) => {
    if (confirm('¿Estás seguro de que deseas eliminar esta pieza?')) {
        router.delete(route('piezas.destroy', id))
            .then(() => {
                router.visit(route('piezas.index'));
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
};

//redireccionar a la página de cambio de estado
const changeState = async() => {
    router.visit(route('piezas.changeState'));
}
</script>
<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>

        <div class="bg-gray-100 py-10">
            <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-xl font-semibold text-gray-900">
                                Gestión de Piezas
                            </h1>
                            <p class="mt-2 text-sm text-gray-700">
                                Listado de todas las piezas registradas en el sistema. Puedes agregar, editar o eliminar
                                piezas según sea necesario.
                            </p>
                        </div>

                        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                            <Link :href="route('piezas.create')"
                                class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                            Agregar Pieza
                            </Link>
                            <!--mostrar boton si hay al menos 1 registro en piezas-->
                            <button v-if="piezas.data.length > 0" @click="changeState"
                                class="ml-4 inline-flex items-center justify-center rounded-md border border-transparent bg-green-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 sm:w-auto">
                            Cambiar Estado de Piezas
                            </button>
                            <!-- icono boton para ver los graficos -->
                            <Link :href="route('piezas.graficos')"
                                class="ml-4 inline-flex items-center justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:w-auto">
                            Ver Gráficos
                            </Link>
                        </div>
                    </div>

                    <div class="flex flex-col justify-between sm:flex-row mt-6">
                        <div class="relative text-sm text-gray-800 col-span-3">
                            <!--<div
                            class="absolute pl-2 left-0 top-0 bottom-0 flex items-center pointer-events-none text-gray-500">
                            <MagnifyingGlass />
                        </div>
                        -->

                            <!--<input type="text" autocomplete="off" placeholder="Buscar piezas" id="search"
                            class="block rounded-lg border-0 py-2 pl-10 text-gray-900 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />-->
                        </div>
                    </div>

                    <div class="mt-8 flex flex-col">
                        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div
                                    class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg relative">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                                    ID
                                                </th>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                                    Código
                                                </th>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                                    Pieza
                                                </th>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                                    Peso teórico
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Peso real
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Estado
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Proyecto
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Bloque
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Fecha de Registro
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Registrado por
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Acciones
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white">
                                            <tr v-for="pieza in props.piezas.data" :key="pieza.id">
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                    {{ pieza.id }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-500 sm:pl-6">
                                                    {{ pieza.codigo }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-500 sm:pl-6">
                                                    {{ pieza.pieza }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    {{ pieza.peso_teorico }}
                                                </td>
                                                <td :class="[
                                                    'whitespace-nowrap px-3 py-4 text-sm font-medium',
                                                     pieza.estado === 'Fabricado'
                                                        ? ' text-green-400'
                                                        : 'text-orange-400'
                                                ]">
                                                    {{ (pieza.peso_real) ? pieza.peso_real.toFixed(1) : 'Pendiente....'
                                                    }}
                                                </td>
                                                <td :class="[
                                                    'text-sm font-medium',
                                                    pieza.estado === 'Fabricado'
                                                        ? ' text-green-400'
                                                        : 'text-orange-400'
                                                ]">
                                                    {{ pieza.estado }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    {{ pieza.bloque.proyecto.codigo }} - {{ pieza.bloque.proyecto.nombre
                                                    }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    {{ pieza.bloque.nombre }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    {{ formatFecha(pieza.created_at) }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    {{ pieza.user.username }}
                                                </td>
                                                <td
                                                    class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 flex justify-start space-x-4">
                                                    <Link :href="route('piezas.edit', pieza.id)"
                                                        class="text-indigo-600 hover:text-indigo-900">
                                                    <EditIcon />
                                                    </Link>
                                                    <Link @click.prevent="destroyPieza(pieza.id)"
                                                        class="text-red-600 hover:text-red-900">
                                                    <RemoveIcon />
                                                    </Link>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <Pagination :data="piezas" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>