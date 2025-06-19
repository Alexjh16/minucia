<script setup>
import Pagination from '@/Components/Icons/Pagination.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import RemoveIcon from '@/Components/Icons/RemoveIcon.vue';
import EditIcon from '@/Components/Icons/EditIcon.vue';
import { Head, Link } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
const props = defineProps({
    proyectos: Object
});


const destroyProyecto = (id) => {
    if (confirm('¿Estás seguro de que deseas eliminar este proyecto?')) {
        Inertia.delete(route('proyectos.destroy', id), {
            onSuccess: () => {
                // Aquí puedes manejar la respuesta después de eliminar el proyecto
                console.log('Proyecto eliminado con éxito');
            },
            onError: (error) => {
                // Manejo de errores
                console.error('Error al eliminar el proyecto:', error);
            }
        });
    }
};

</script>
<template>

    <Head title="Proyectos" />
    <AuthenticatedLayout>

        <div class="bg-gray-100 py-10">
            <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-xl font-semibold text-gray-900">
                                Gestión de Proyectos
                            </h1>
                            <p class="mt-2 text-sm text-gray-700">
                                Listado de todos los proyectos registrados en el sistema. Puedes agregar, editar o
                                eliminar proyectos según sea necesario.
                            </p>
                        </div>

                        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                            <Link :href="route('proyectos.create')"
                                class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                            Agregar Proyecto
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
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg relative">
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
                                                Nombre
                                            </th>                                           
                                            <th scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                        <tr v-for="proyecto in props.proyectos.data" :key="proyecto.id">
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                {{ proyecto.id }} 
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-500 sm:pl-6">
                                                {{ proyecto.codigo }}
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-500 sm:pl-6">
                                                {{ proyecto.nombre }}
                                            </td>
                                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 flex justify-start space-x-4">
                                                <Link 
                                                :href="route('proyectos.edit', proyecto.id)"
                                                    class="text-indigo-600 hover:text-indigo-900">
                                                    <EditIcon />
                                                </Link>
                                                <Link 
                                                @click.prevent="destroyProyecto(proyecto.id)"
                                                href="#"
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

                <Pagination :data="proyectos"/>
            </div>
        </div>
    </AuthenticatedLayout>
</template>