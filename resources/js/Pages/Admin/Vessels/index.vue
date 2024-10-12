<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref, watch, computed } from 'vue';
import Dropdown from '@/Components/Dropdown.vue';
import vesselForm from './vesselForm.vue';
const props = defineProps({
    vessels:
    {
        type: Object
    },
    filters: {
        String
    },
    types: {
        type: Array
    },
    flags: {
        type: Array
    }
})
const search = ref(''), pageNumber = ref(0)
const filters = ref('')
const changeFilter = (value) => {
    filters.value = value
}


let vesselUrl = computed(() => {
    let url = new URL(route("vessels.index"))
    url.searchParams.append("pageNumber", pageNumber.value)
    if (search.value) {
        url.searchParams.append("search", search.value)
    }
    if (filters.value) {
        url.searchParams.append("search", filters.value)
    }

    return url;
});

watch(vesselUrl, newUrl => {
    router.visit(newUrl, {
        preserveState: true,
        preserveScroll: true,
        replace: true
    })
})



</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Vessels</h2>
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
                        <h1 class="text-xl text-center font-bold"> Vessels </h1>
                        <div class="flex flex-row">
                            <!--flag filter-->
                            <div class="mx-2">
                                <Dropdown align="left" width="48" contentClasses="py-2 bg-gray-100 me-2">
                                    <template #trigger>
                                        <div
                                            class="flex flex-row bg-white border-gray-300 border-2 rounded-md py-2 px-2">
                                            Vessel Flag <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </div>
                                    </template>
                                    <template #content>
                                        <button @click="changeFilter('')">All</button>
                                        <div v-for="(flag, index) in flags" :key="index">
                                            <button @click="changeFilter(flag)">{{ flag }}</button>
                                        </div>
                                    </template>
                                </Dropdown>
                            </div>

                            <!--Type Filter-->
                            <div class="me-2">
                                <Dropdown align="left" width="48" contentClasses="py-2 bg-gray-100">
                                <template #trigger>
                                    <div class="flex flex-row bg-white border-gray-300 border-2 rounded-md py-2 px-2">
                                        Vessel Type <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </div>
                                </template>
                                <template #content>
                                    <button @click="changeFilter('')">All</button>
                                    <div v-for="(type, index) in types" :key="index">
                                        <button @click="changeFilter(type)">{{ type }}</button>
                                    </div>
                                </template>
                            </Dropdown>
                            </div>


                            <input type="text" v-model="search" class="rounded-md border-slate-400" name="search"
                                placeholder="search.....">
                        </div>
                        <!--Flag Filter-->

                    </div>

                    <table v-show="vessels.data.length > 0" class="mx-auto divide-y-2 divide-gray-200 bg-white text-sm">
                        <thead class="ltr:text-left rtl:text-right">
                            <tr>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Vessle Name</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Flag</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Vessel Type</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">IMO Number</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Built</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">GRT</th>
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
                                    <a :href="route('vessel.show', [vessel])"
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
