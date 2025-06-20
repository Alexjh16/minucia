<script setup>
import { ref, watch } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    proyectos: Object,    
});

let bloques = ref([]);
let piezas = ref([]);

const form = useForm({
    pieza: '',
    peso_teorico: '',
    peso_real: '',
    diferencia_peso: '0.00',
    estado: '',
    pieza_id: '',
    proyecto_id: '',
    bloque_id: '',
    fecha_registro: '',
    creado_por: ''
});

//watch para obtener los bloques cuando se selecciona un proyecto
watch(() => form.proyecto_id, (newValue) => {
    if (!newValue) {
        bloques.value = []; // Limpiar bloques si no hay proyecto seleccionado
        return;
    }
   getBloques(newValue);
});

//watch para obtener las piezas cuando se selecciona un bloque
watch(() => form.bloque_id, (newValue) => {
    if (!newValue) {
        piezas.value = []; // Limpiar piezas si no hay bloque seleccionado
        return;
    }
    getPiezas(newValue);
});


//si proyectoId es vacio de nuevo dejar bloques vacio
const getBloques = (proyectoId) => {
    axios.get('/api/bloques?proyecto_id=' + proyectoId)
        .then((response) => {
            bloques.value = response.data;
        })
        .catch((error) => {
            console.error('Error al obtener bloques:', error);
            bloques.value = []; // Limpiar bloques en caso de error
        });
}

const getPiezas = (bloqueId) => {
    axios.get('/api/piezas?bloque_id=' + bloqueId)
        .then((response) => {
            piezas.value = response.data;
        })
        .catch((error) => {
            console.error('Error al obtener piezas:', error);
            piezas.value = []; // Limpiar piezas en caso de error
        });
}

const getPiezaData = (piezaId) => {
    axios.get('/api/piezas/' + piezaId)
        .then((response) => {
            const data = response.data.data;
            form.pieza = data.pieza;
            form.peso_teorico = data.peso_teorico;
            form.peso_real = data.peso_real;
            form.creado_por = data.user.username;
            calcularDiferencia(); // Calcular diferencia al cargar los datos
        })
        .catch((error) => {
            console.error('Error al obtener datos de la pieza:', error);
        });
};
const calcularDiferencia = () => {

    if (form.peso_teorico && form.peso_real) {
        const teorico = parseFloat(form.peso_teorico);
        const real = parseFloat(form.peso_real);
        const diferencia = real - teorico;
        form.diferencia_peso = diferencia.toFixed(2); // Formatear a
        
    }
};

const updateStatePieza = () => {
    form.put(route('piezas.update', form.pieza_id));
};

</script>
<template>

    <Head title="Actualizar Pieza" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Actualización del estado  Pieza</h2>
        </template>
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
                <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-12">
                    <form @submit.prevent="updateStatePieza" class="space-y-8 divide-y divide-gray-200">
                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                            <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                                <div>
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                                        Información de la Pieza
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Complete los campos a continuación para modificar las piezas en estado Pendiente.
                                    </p>
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
                                            <option v-for="bloque in bloques.data" :key="bloque.id" :value="bloque.id">
                                                {{ bloque.nombre }}
                                            </option>
                                        </select>
                                        <InputError :message="form.errors.bloque_id" class="mt-2" />
                                    </div>

                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="pieza" class="block text-sm font-medium text-gray-700">Pieza</label>
                                        <select id="pieza"
                                            @change="getPiezaData($event.target.value)"
                                            v-model="form.pieza_id"
                                            class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            :class="{' focus:ring-red-500 focus:border-red-500 border-red-300': form.errors.pieza }">
                                            <option value="">
                                                Selecciona una Pieza
                                            </option>
                                            <option v-for="pieza in piezas.data" :key="pieza.id" :value="pieza.id">
                                                {{ pieza.pieza }}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="creado_por" class="block text-sm font-medium text-gray-700">Creado por</label>
                                        <input 
                                        disabled
                                        placeholder="Usuario que creó la pieza..."
                                        v-model="form.creado_por"
                                        type="text" id="creado_por" autocomplete="creado_por"
                                            class="bg-gray-200 mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none  sm:text-sm "
                                            :class="{' focus:ring-red-500 focus:border-red-500 border-red-300': form.errors.creado_por }" />

                                        <InputError :message="form.errors.creado_por" class="mt-2" />
                                    </div>

                                    

                                    <!-- peso teórico -->
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="peso_teorico" class="block text-sm font-medium text-gray-700">Peso teórico (kg)</label>
                                        <input
                                            type="float" id="peso_teorico" min="1"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            :class="{' focus:ring-red-500 focus:border-red-500 border-red-300': form.errors.peso_teorico }"
                                            v-model="form.peso_teorico" />

                                        <InputError :message="form.errors.peso_teorico" class="mt-2" />
                                    </div>
                                    

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="peso_real" class="block text-sm font-medium text-gray-700">Peso real (kg)</label>
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
                                        <label for="diferencia_peso" class="block text-sm font-medium text-gray-700">Diferencia de peso (kg)</label>
                                        <input
                                            type="text" id="diferencia_peso" disabled
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none bg-gray-200 sm:text-sm"
                                            :class="{' focus:ring-red-500 focus:border-red-500 border-red-300': form.errors.diferencia_peso }"
                                            v-model="form.diferencia_peso" />
                                        <InputError :message="form.errors.diferencia_peso" class="mt-2" />
                                    </div>
                                    <!--error o errores que puede retonar el servidor-->
                                    <InputError :message="form.errors" class="mt-2" />
                                </div>
                            </div>
                            <div class="px-4 py-3  bg-gray-50 text-right sm:px-6">
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