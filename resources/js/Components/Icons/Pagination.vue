<script setup>
import { usePage } from '@inertiajs/inertia-vue3';
import { router } from '@inertiajs/vue3'

//recibe la data para hacer la respectiva paginación
const props = defineProps({
    data: Object,
});
//obtener la url retornda
const fullUrl = props.data.meta.path;
const splitUrl = fullUrl.split('/');

const visitPage = splitUrl[3];

const updatePageNummber = (link) => {
    let pageNumber = link.url.split("=")[1];
    console.log(pageNumber);
    router.visit(visitPage + '?page=' + pageNumber, {
        preserveState: true,
        preserveScroll: true,
    });
};

</script>
<template>
    
    <div class="mx-auto max-w-8xl py-4 px-4 sm:px-6 lg:px-8">
        <div class="max-w-none mx-auto">
            <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    <div class="flex-1 flex justify-between sm:hidden" />
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Showing
                                <!-- space -->
                                <span class="font-medium">{{ props.data.meta.from }}</span>
                                <!-- space -->
                                to
                                <!-- space -->
                                <span class="font-medium">{{ props.data.meta.to }}</span>
                                <!-- space -->
                                of
                                <!-- space -->
                                <span class="font-medium">{{ props.data.meta.total }}</span>
                                <!-- space -->
                                results
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                                aria-label="Pagination">
                                <button
                                @click.prevent="updatePageNummber(link)"
                                :disabled="link.active || !link.url"
                                v-for="(link, index) in props.data.meta.links"
                                 :key="index" 
                                 class="relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                                    :class="{
                                        'z-10 bg-indigo-50 border-indigo-500 text-indigo-600': link.active,
                                        'bg-white border-gray-300 text-gray-500 hover:bg-gray-50': !link.active && link.url,
                                        'bg-gray-200 border-gray-200 text-gray-400 cursor-not-allowed': !link.url,
                                    }">
                                    <span v-html="link.label"></span>
                                </button>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>