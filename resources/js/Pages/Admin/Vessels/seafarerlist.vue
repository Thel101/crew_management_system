<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { debounce } from 'lodash';
import vesselForm from './vesselForm.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import html2pdf from 'html2pdf.js';
const props = defineProps({
    seafarers:
    {
        type: Object
    },
    vessel: {
        type: Object
    },
    pagination: {
        type: Boolean
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
const filename = props.vessel.name + 'crew list'
const printHide = ref(true);
const printPdf = () => {
    printHide.value = false
    const printElement = document.getElementById('printableSection');
    if (printElement) {
        html2pdf(printElement, {
            margin: 1,
            filename: filename,
            html2canvas: { scale: 2 },
            jsPDF: { format: 'letter', orientation: 'portrait' }
        })
        elementsToHide.forEach(el => el.style.display = '');
    }
    printHide.value = false


}
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Seafarers on {{ vessel.name }}</h2>
        </template>
        <div v-show="printHide">
            <vesselForm :vessel="props.vessel" :name="props.vessel.name" :flag="props.vessel.flag"
                :type="props.vessel.type" :IMO_number="props.vessel.IMO_number" :built="props.vessel.built"
                :GRT="props.vessel.GRT" :DWT="props.vessel.DWT" :Engine="props.vessel.Engine" :BHP="props.vessel.BHP"
                :trade="props.vessel.Trade" :edit="true"></vesselForm>
        </div>
        <div class="py-12" id="printableSection">
            <h2 v-show="!printHide" class="font-semibold text-xl text-gray-800 leading-tight">Seafarers on {{ vessel.name }}</h2>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"></h2>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <a v-show="printHide" :href="route('vessels.show', [props.vessel, true])">View All</a>
                <PrimaryButton v-show="printHide" @click="printPdf">Print</PrimaryButton>
                <div class="overflow-x-auto">
                    <div class="flex flex-row justify-between my-5">
                        <h1 class="text-xl text-center lg:ms-14 md:ms-4"> Crew List </h1>
                        <input v-show="printHide" type="text" v-model="search" class="rounded-md border-slate-400 lg:me-14 md:me-4"
                            name="search" placeholder="search.....">
                    </div>
                    <!--view all-->
                    <table v-if="pagination == false && seafarers.length > 0"
                        class="mx-auto divide-y-2 divide-gray-200 bg-white text-sm">
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

                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ seafarer.fullname
                                    }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ seafarer.email }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ seafarer.role.name }} </td>


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
                <!--paginated table-->
                <table v-if="pagination == true && seafarers.data.length > 0"
                    class="mx-auto divide-y-2 divide-gray-200 bg-white text-sm">
                    <thead class="ltr:text-left rtl:text-right">
                        <tr>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Name</th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Email</th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Seaman book</th>

                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"></th>

                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        <tr v-for="seafarer in seafarers.data" :key="seafarer.id">

                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ seafarer.fullname }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ seafarer.email }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ seafarer.role.name }} </td>


                            <td class="whitespace-nowrap px-4 py-2">
                                <a href="#"
                                    class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700">
                                    View
                                </a>
                            </td>
                        </tr>


                    </tbody>
                </table>
                <div v-if="pagination == true" class="flex justify-end">

                    <ul class="flex">
                        <li class="mr-2" v-for="link in seafarers.links" :key="link.label">
                            <a :href="link.url" v-html="link.label"></a>
                        </li>
                    </ul>
                </div>



            </div>



        </div>

    </AuthenticatedLayout>
</template>
