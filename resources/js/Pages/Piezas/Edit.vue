<script setup>
import { ref, watch } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    pieza: Object,
    bloques: Object,
    proyectos: Object,
});

let pieza = usePage().props.pieza.data;
const form = useForm({
    pieza: pieza.pieza,
    peso_teorico: pieza.peso_teorico,
    peso_real: pieza.peso_real,
    diferencia_peso: '0.00',
    estado: pieza.estado,
    proyecto_id: pieza.bloque.proyecto.id,
    bloque_id: pieza.bloque.id,
    fecha_registro: pieza.created_at,
    creado_por: pieza.user.username
});


const formPesos = ref({
    peso_teorico: '',
    peso_real: '',
    diferencia_peso: '',
});

const calcularDiferencia = () => {
    if (formPesos.value.peso_teorico && formPesos.value.peso_real) {
        const teorico = parseFloat(formPesos.value.peso_teorico);
        const real = parseFloat(formPesos.value.peso_real);
        formPesos.value.diferencia_peso = (real - teorico).toFixed(2);
    }
};

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
                                        <label for="pieza" class="block text-sm font-medium text-gray-700">Pieza</label>
                                        <input 
                                        v-model="form.pieza"
                                        autocomplete="pieza"
                                        type="text" id="pieza"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                                            :class="{' focus:ring-red-500 focus:border-red-500 border-red-300': form.errors.pieza }"
                                            />

                                    <InputError :message="form.errors.pieza" class="mt-2" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="creado_por" class="block text-sm font-medium text-gray-700">Creado por</label>
                                        <input 
                                        disabled
                                        placeholder="PZ-XXXX"
                                        v-model="form.creado_por"
                                        type="text" id="creado_por" autocomplete="creado_por"
                                            class="bg-gray-200 mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none  sm:text-sm "
                                            :class="{' focus:ring-red-500 focus:border-red-500 border-red-300': form.errors.creado_por }" />

                                        <InputError :message="form.errors.creado_por" class="mt-2" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label
                                            for="marca"
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
                                            <option v-for="proyecto in proyectos.data" :key="proyecto.id" :value="proyecto.id">
                                               {{ proyecto.codigo }} - {{ proyecto.nombre }}
                                            </option>
                                        </select>
                                        <InputError :message="form.errors.proyecto_id" class="mt-2" />
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
                                            <option v-for="bloque in props.bloques.data" :key="bloque.id" :value="bloque.id">
                                                {{ bloque.nombre }}
                                            </option>
                                        </select>
                                        <InputError :message="form.errors.bloque_id" class="mt-2" />
                                    </div>

                                    <!-- peso teórico -->
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="peso_teorico" class="block text-sm font-medium text-gray-700">Peso teórico</label>
                                        <input
                                            type="float" id="peso_teorico" min="1"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            :class="{' focus:ring-red-500 focus:border-red-500 border-red-300': form.errors.peso_teorico }"
                                            v-model="form.peso_teorico" />

                                        <InputError :message="form.errors.peso_teorico" class="mt-2" />
                                    </div>
                                    

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="peso_real" class="block text-sm font-medium text-gray-700">Peso real</label>
                                        <input
                                        @input="calcularDiferencia()"
                                        placeholder="$0.00"
                                         type="float" id="peso_real" autocomplete="peso_real"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            v-model="form.peso_real" />
                                        <InputError :message="form.errors.peso_real" class="mt-2" />
                                    </div>


                                    <!--input no editable para calcular la diferencia de peso teorico y peso real -->
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="diferencia_peso" class="block text-sm font-medium text-gray-700">Diferencia de peso</label>
                                        <input
                                            type="text" id="diferencia_peso" disabled
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none bg-gray-200 sm:text-sm"
                                            :class="{' focus:ring-red-500 focus:border-red-500 border-red-300': form.errors.diferencia_peso }"
                                            v-model="form.diferencia_peso" />
                                        <InputError :message="form.errors.diferencia_peso" class="mt-2" />
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