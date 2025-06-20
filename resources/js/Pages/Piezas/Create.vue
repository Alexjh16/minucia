<script setup>
import { ref, watch } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import axios from 'axios';

const props = defineProps({
    proyectos: Object, 
});

let bloques = ref([]);

const form = useForm({
    pieza: '',
    peso_teorico: '',
    estado: 'Pendiente',
    proyecto_id: '',
    bloque_id: '',
});

watch(() => form.proyecto_id, (newValue) => {
   getBloques(newValue);
});

const getBloques = (proyectoId) => {
    axios.get('/api/bloques?proyecto_id=' + proyectoId)
        .then((response) => {
            bloques.value = response.data;
        })
}
const createPieza = () => {
    form.post(route('piezas.store'));
};

</script>
<template>

    <Head title="Registrar Pieza" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Registro de Pieza</h2>
        </template>
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
                <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-12">
                    <form @submit.prevent="createPieza" class="space-y-8 divide-y divide-gray-200">
                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                            <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                                <div>
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                                        Información de la Pieza
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Complete los campos necesarios para actualizar la Información de la Pieza.
                                    </p>
                                </div>

                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="pieza" class="block text-sm font-medium text-gray-700">Pieza</label>
                                        <input 
                                        v-model="form.pieza"
                                        autocomplete="pieza"
                                        placeholder="B01"
                                        type="text" id="pieza"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                                            :class="{' focus:ring-red-500 focus:border-red-500 border-red-300': form.errors.pieza }"
                                            />

                                    <InputError :message="form.errors.pieza" class="mt-2" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="codigo" class="block text-sm font-medium text-gray-700">Peso Teórico</label>
                                        <input 
                                        placeholder="0.00"
                                        v-model="form.peso_teorico"
                                        type="float" id="codigo" autocomplete="codigo"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm "
                                            :class="{' focus:ring-red-500 focus:border-red-500 border-red-300': form.errors.peso_teorico }" />

                                        <InputError :message="form.errors.peso_teorico" class="mt-2" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label
                                            for="proyecto_id"
                                            class="block text-sm font-medium text-gray-700"
                                            >Proyecto</label
                                        >
                                        <select
                                            v-model="form.proyecto_id"
                                            id="proyecto_id"
                                            class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            :class="{' focus:ring-red-500 focus:border-red-500 border-red-300': form.errors.proyecto_id }"
                                        >
                                            <option value="">
                                                Seleccionar un Proyecto
                                            </option>
                                            <option v-for="proyecto in props.proyectos.data" :key="proyecto.id" :value="proyecto.id">
                                                {{ proyecto.codigo }} - {{ proyecto.nombre }}
                                            </option>
                                            
                                        </select>
                                        <InputError :message="form.errors.marca" class="mt-2" />
                                    </div>

                                    

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="bloque_id"
                                            class="block text-sm font-medium text-gray-700">Bloque</label>
                                        <select id="bloque_id"
                                            v-model="form.bloque_id"
                                            class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            :class="{' focus:ring-red-500 focus:border-red-500 border-red-300': form.errors.bloque_id }">
                                            <option value="">
                                                Selecciona un Bloque
                                            </option>
                                            <option v-for="bloque in bloques.data" :key="bloque.id" :value="bloque.id">
                                                {{ bloque.nombre }}
                                            </option>
                                        </select>
                                        <InputError :message="form.errors.bloque_id" class="mt-2" />
                                    </div>

                                    <!--error o errores que puede retonar el servidor-->
                                    <!--<InputError :message="form.errors" class="mt-2" />-->
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
                                    Registrar Pieza
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>