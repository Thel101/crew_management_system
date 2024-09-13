<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref, watch } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { debounce } from 'lodash';

const props = defineProps({
    seafarers:
    {
        type: Object
    },
    vessel:{
        type: Object
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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Seafarers on {{ vessel.name }}</h2>
            <h3>Estimated Sign On Date: {{ vessel }}</h3>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="overflow-x-auto">
                    <div class="flex flex-row justify-between my-5">
                        <h1 class="text-xl text-center lg:ms-14 md:ms-4"> Vessels </h1>
                        <input type="text" v-model="search" class="rounded-md border-slate-400 lg:me-14 md:me-4"
                            name="search" placeholder="search.....">
                    </div>

                    <table v-show="seafarers.length > 0" class="mx-auto divide-y-2 divide-gray-200 bg-white text-sm">
                        <thead class="ltr:text-left rtl:text-right">
                            <tr>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Name</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Email</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Seaman book</th>

                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"></th>

                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            <tr v-for="seafarer in seafarers" :key="seafarer.id">
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ seafarer.seafarer.fullname }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ seafarer.seafarer.email }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ seafarer.role.name }}</td>


                                <td class="whitespace-nowrap px-4 py-2">
                                    <a href="#"
                                        class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700">
                                        View
                                    </a>
                                </td>
                            </tr>


                        </tbody>
                    </table>
                </div>
                <!-- <div class="flex justify-end" v-if="vessels.links.length > 0">
                    <ul class="flex">
                        <li class="mr-2" v-for="link in vessels.links" :key="link.label">
                            <a :href="link.url" v-html="link.label"></a>
                        </li>
                    </ul>
                </div> -->



            </div>



        </div>

    </AuthenticatedLayout>
</template>
