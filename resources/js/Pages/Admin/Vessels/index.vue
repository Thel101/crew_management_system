<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { debounce } from 'lodash';
import vesselForm from './vesselForm.vue';
const props = defineProps({
    vessels:
    {
        type: Object
    },
    filters: {
        String
    }
})
const search = ref(props.filters);
watch(search, debounce((value) => {
    Inertia.get(route('vessels.index'), { search: value },
        {
            preserveState: true,
            replace: true
        }
    );
}, 300));




</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Roles</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <vesselForm></vesselForm>

                </div>
                <div v-show="vessels.data.length <= 0">
                    <h1 class="text-center text-red-500 font-bold text-2xl">There is no registered vessels!</h1>
                </div>
                <h1 v-show="vessels.length > 0" class="text-xl font-bold text-center">Vessels</h1>
                <div class="overflow-x-auto">
                    <div class="flex flex-row justify-between min-w-xl w-lg my-5">
                        <h1 class="text-xl text-center lg:ms-14 md:ms-4"> Vessels </h1>
                        <input type="text" v-model="search" class="rounded-md border-slate-400 lg:me-14 md:me-4"
                            name="search" placeholder="search.....">
                    </div>

                    <table v-show="vessels.data.length > 0" class="mx-auto divide-y-2 divide-gray-200 bg-white text-sm">
                        <thead class="ltr:text-left rtl:text-right">
                            <tr>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Vessle Name</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Flag</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Vessel Type</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">IMO Number</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Built</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">DWT</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Engine</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">BHP</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Trade</th>
                                <th class="px-4 py-2"></th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            <tr v-for="vessel in vessels.data" :key="vessel.id">
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ vessel.name }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ vessel.flag }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ vessel.type }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ vessel.IMO_number }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ vessel.built }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ vessel.GRT }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ vessel.DWT }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ vessel.Engine }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ vessel.BHP }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ vessel.Trade }}</td>

                                <td class="whitespace-nowrap px-4 py-2">
                                    <a :href="route('vessels.show', vessel)"
                                        class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700">
                                        View
                                    </a>

                                </td>
                            </tr>


                        </tbody>
                    </table>
                </div>
                <div class="flex justify-end" v-if="vessels.links.length > 0">
                    <ul class="flex">
                        <li class="mr-2" v-for="link in vessels.links" :key="link.label">
                            <a :href="link.url" v-html="link.label"></a>
                        </li>
                    </ul>
                </div>



            </div>



        </div>

    </AuthenticatedLayout>
</template>
