<script setup>
import { ref, watch } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    pieza: Object,
    proveedores: Object
});



let pieza = usePage().props.pieza.data;
const form = useForm({
    nombre: pieza.nombre,
    codigo: pieza.codigo,
    marca: pieza.marca,
    proveedor_id: pieza.proveedor.id,
    cantidad: pieza.cantidad,
    precio: pieza.precio,
    descripcion: pieza.descripcion,
});


const updatePieza = () => {
    form.put(route('piezas.update', pieza.id));
};

</script>
<template>

    <Head title="Actualizar Pieza" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Actualización de Pieza</h2>
        </template>
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
                <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-12">
                    <form @submit.prevent="updatePieza" class="space-y-8 divide-y divide-gray-200">
                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                            <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                                <div>
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                                        Información de la Pieza
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Complete los campos a continuación para registrar una nueva pieza.
                                    </p>
                                </div>

                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                                        <input 
                                        v-model="form.nombre"
                                        autocomplete="nombre"
                                        type="text" id="nombre"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                                            :class="{' focus:ring-red-500 focus:border-red-500 border-red-300': form.errors.nombre }"
                                            />

                                    <InputError :message="form.errors.nombre" class="mt-2" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="codigo" class="block text-sm font-medium text-gray-700">Código</label>
                                        <input 
                                        placeholder="PZ-XXXX"
                                        v-model="form.codigo"
                                        type="text" id="codigo" autocomplete="codigo"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm "
                                            :class="{' focus:ring-red-500 focus:border-red-500 border-red-300': form.errors.codigo }" />

                                        <InputError :message="form.errors.codigo" class="mt-2" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label
                                            for="marca"
                                            class="block text-sm font-medium text-gray-700"
                                            >Marca</label
                                        >
                                        <select
                                            v-model="form.marca"
                                            id="marca"
                                            class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            :class="{' focus:ring-red-500 focus:border-red-500 border-red-300': form.errors.marca }"
                                        >
                                            <option value="">
                                                Seleccionar una Marca
                                            </option>
                                            <option value="Marca A">Marca A</option>
                                            <option value="Marca B">Marca B</option>
                                            <option value="Marca C">Marca C</option>
                                        </select>
                                        <InputError :message="form.errors.marca" class="mt-2" />
                                    </div>

                                    

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="proveedor_id"
                                            class="block text-sm font-medium text-gray-700">Proveedor</label>
                                        <select id="proveedor_id"
                                            v-model="form.proveedor_id"
                                            class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            :class="{' focus:ring-red-500 focus:border-red-500 border-red-300': form.errors.proveedor_id }">
                                            <option value="">
                                                Selecciona un Proveedor
                                            </option>
                                            <option v-for="proveedor in props.proveedores.data" :key="proveedor.id" :value="proveedor.id">
                                                {{ proveedor.nombre }}
                                            </option>
                                        </select>
                                        <InputError :message="form.errors.proveedor_id" class="mt-2" />
                                    </div>

                                    <!-- cantidad -->
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="cantidad" class="block text-sm font-medium text-gray-700">Cantidad</label>
                                        <input 
                                            type="number" id="cantidad" min="1"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            :class="{' focus:ring-red-500 focus:border-red-500 border-red-300': form.errors.cantidad }"
                                            v-model="form.cantidad" />

                                        <InputError :message="form.errors.cantidad" class="mt-2" />
                                    </div>
                                    

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="precio" class="block text-sm font-medium text-gray-700">Precio</label>
                                        <input
                                        placeholder="$0.00"
                                         type="text" id="precio" autocomplete="precio"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            v-model="form.precio" />
                                        <InputError :message="form.errors.precio" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                                        <textarea id="descripcion" rows="3"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            :class="{' focus:ring-red-500 focus:border-red-500 border-red-300': form.errors.descripcion }"
                                            v-model="form.descripcion"
                                            @error="form.errors.descripcion = $message"></textarea>
                                        <p class="mt-2 text-sm text-gray-500">
                                            Proporcione una descripción detallada de la pieza.
                                        </p>
                                        <InputError :message="form.errors.descripcion" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <Link 
                                    :href="route('piezas.index')"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-4">
                                    Cancelar
                                </Link>
                                <button type="submit"
                                    class="bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Actualizar Pieza
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>