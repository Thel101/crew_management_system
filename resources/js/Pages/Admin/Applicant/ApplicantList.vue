<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { computed, ref, watch } from 'vue'
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Dropdown from '@/Components/Dropdown.vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';

const props = defineProps({
    applicants:
    {
        type: Object
    },
    jobs: {
        type: [Array, String]
    },
    assigne: {
        type: Object
    }
})

const form = useForm({
    user_id: '',
    role_id: '',
    vessel_id: ''
});

const showAssignForm = ref(false)
const seafarer_name = ref('');
const seaman_book = ref('');
const seafarer_role = ref('');
const assignRoleId = ref('')
const search = ref(''), pageNumber = ref(0)
const AssignSeafarer = (id, role_name, roleId) => {
    showAssignForm.value = true
    seafarer_role.value = role_name
    assignRoleId.value = roleId
    form.user_id = id
}
watch([() => assignRoleId.value, () => form.user_id], ([newRoleId, newUserId]) => {
    if (newRoleId && newUserId) {
        router.visit(route('applicants.list', { role_id: newRoleId, user_id: newUserId }));
    }
});



if (props.assigne) {
    seafarer_name.value = props.assigne.fullname
    seaman_book.value = props.assigne.seaman_book
    seafarer_role.value = props.assigne.role.name
    form.user_id = props.assigne.id
    form.role_id = props.assigne.role_id
}



const selectedVessel = ref('');
const selectVessel = (vessel_id, vessel_name) => {
    selectedVessel.value = vessel_name;
    form.vessel_id = vessel_id
}

const assign = () => {
    form.patch(route('applicant.status'), {
        onSuccess: () => {
            form.reset();
            showAssignForm.value = false
        }
    })
}
let applicantUrl = computed(() => {
    let url = new URL(route("applicants.list"))
    url.searchParams.append("pageNumber", pageNumber.value)
    if (search.value) {
        url.searchParams.append("search", search.value)
    }


});

watch(applicantUrl, newUrl => {
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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Applicants</h2>
        </template>

        <div class="py-12">
            <div class="max-w-4xl mx-auto flex flex-row justify-between">
                <div>
                    <Link :href="route('seafarer.form')" class="justify-end mb-5">
                    <PrimaryButton>On-board seafarer</PrimaryButton>
                    </Link>
                </div>
                <div v-show="applicants.data.length > 0">
                    <input type="text" v-model="search" placeholder="Search..."
                        class="rounded-md border-slate-400 mb-4">
                </div>

            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden">

                    <div v-show="applicants.data.length < 1" class="text-center text-red-400 font-bold text-2xl">There
                        is no
                        applicants!</div>

                    <table v-show="applicants.data.length > 0"
                        class="mx-auto divide-y-2 divide-gray-200 bg-white text-sm">
                        <thead class="ltr:text-left rtl:text-right overflow-x-auto">
                            <tr>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Name</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Seaman Book</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Phone Number</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Email</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Role</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Applied Date</th>
                                <th class="px-4 py-2"></th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            <tr v-for="applicant in applicants.data" :key="applicant.id">

                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ applicant.fullname }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ applicant.seaman_book }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ applicant.mobile_no }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ applicant.email }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ applicant.role.name }}</td>

                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ new
                                    Date(applicant.created_at).toLocaleDateString('en-US') }}</td>


                                <td class="whitespace-nowrap py-2">
                                    <div v-if="applicant.passport.length > 0">
                                        <a :href="route('applicant.detail', applicant.id)" class="mr-4 inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium
                                            text-white hover:bg-indigo-700">
                                            View
                                        </a>
                                        <!-- :href="route('assign.seafarer', applicant.id, applicant.role.id) -->
                                        <Link :href="route('assign.seafarer', [applicant.id, applicant.role.id])"
                                            class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700">
                                        Assign
                                        </Link>
                                    </div>

                                    <a v-else :href="route('passport.index', applicant.id)"
                                        class="mr-2 inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700">
                                        Attach
                                    </a>

                                </td>
                            </tr>


                        </tbody>
                    </table>
                    <div v-show="applicants.data.length > 0" class="flex justify-end lg:me-24"
                        v-if="applicants.links.length > 0">
                        <ul class="flex">
                            <li class="mr-2" v-for="link in applicants.links" :key="link.label">
                                <a :href="link.url" v-html="link.label"></a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>


        </div>

        <div v-show="showAssignForm">
            <div class="max-w-lg mx-auto justify-center">
                <h1></h1>
                <form @submit.prevent="assign">
                    <div class="flex flex-row justify-center gap-2">
                        <div>
                            <InputLabel>Applicant Name</InputLabel>
                            <TextInput v-model="seafarer_name" placeholder="Applicant Name"></TextInput>
                        </div>
                        <div>
                            <InputLabel>Seaman Book Number</InputLabel>
                            <TextInput v-model="seaman_book" placeholder="Applicant Name"></TextInput>
                        </div>
                    </div>
                    <div class="flex flex-row justify-center gap-2">
                        <div>
                            <InputLabel>Role</InputLabel>
                            <TextInput aria-placeholder="Role" v-model="seafarer_role"></TextInput>
                        </div>
                        <div>
                            <InputLabel>Vessel</InputLabel>
                            <Dropdown align="left" width="48" contentClasses="py-2 bg-gray-100">
                                <template #trigger>
                                    <div class="mt-1 px-4 py-2 rounded-md border-2 bg-white text-gray-600 block w-full">
                                        {{ selectedVessel || 'Select Vessel' }}</div>

                                </template>
                                <template #content>
                                    <ul v-if="Array.isArray(jobs)">
                                        <li v-for="job in jobs" :key="job.id"
                                            @click="selectVessel(job.vessel.id, job.vessel.name)"
                                            class="cursor-pointer hover:bg-gray-200"> {{ job.vessel.name }}</li>
                                    </ul>
                                </template>
                            </Dropdown>

                        </div>
                    </div>
                    <div class="flex flex-row justify-center">
                        <PrimaryButton>Assign Seafarer</PrimaryButton>
                    </div>

                </form>

            </div>
        </div>

    </AuthenticatedLayout>
</template>
