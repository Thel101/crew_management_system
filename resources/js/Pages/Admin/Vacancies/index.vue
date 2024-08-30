<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Dropdown from '@/Components/Dropdown.vue';
import { ref } from 'vue';

defineProps
    ({
        vessels:
        {
            type: Array
        },
        roles: {
            type: Array
        },
        jobs: {
            type: Object
        }
    })
const selectedVessel = ref('');
const selectVessel = (vessel_id, vessel_name) => {
    selectedVessel.value = vessel_name;
    form.vessel_id = vessel_id
}
const selectedRole = ref('');
const selectRole = (role_id, role_name) => {
    selectedRole.value = role_name;
    form.role_id = role_id
}
const page = usePage();

const clearFlashMessage = () => {
    page.props.flash.message = null
}
const form = useForm({
    role_id: '',
    vessel_id: '',
    description: '',
    count: 0,
    joining_date: '',
    port: '',
    basic_salary: '',
    requirements: '',
});

const submit = () => {
    form.post(route('jobs.store'), {
        onSuccess: () => {
            form.reset();
            selectedVessel.value = '',
                selectRole.value = ''
        }
    });
};

</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Roles</h2>
        </template>

        <div class="py-12">
            <div v-if="$page.props.flash.message"
                class="max-w-2xl mx-auto bg-green-300 flex flex-row justify-between p-3 rounded-md my-2">
                <span>{{ $page.props.flash.message }}</span>
                <button @click="clearFlashMessage"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg></button>

            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <div class="max-w-2xl mx-auto bg-white shadow sm:rounded-lg p-2 px-5">
                        <h1 class="text-xl font-bold text-center mb-5 mt-3">Create New Job</h1>
                        <form @submit.prevent="submit">

                            <div class="flex flex-row">
                                <div class="w-1/2 mr-2">
                                    <InputLabel for="name" value="Vessel" />

                                    <Dropdown align="left" width="48" contentClasses="py-2 bg-gray-100">
                                        <template #trigger>
                                            <div
                                                class="mt-1 px-4 py-2 rounded-md border-2 bg-white text-gray-600 block w-full">
                                                {{ selectedVessel || 'Select Vessel' }}</div>

                                        </template>
                                        <template #content>
                                            <ul>
                                                <li v-for="vessel in vessels" :key="vessel"
                                                    @click="selectVessel(vessel.id, vessel.name)"
                                                    class="cursor-pointer hover:bg-gray-200">{{ vessel.name }}</li>
                                            </ul>
                                        </template>
                                    </Dropdown>
                                </div>
                                <div class="w-1/2">
                                    <InputLabel for="role" value="Role" />

                                    <Dropdown align="left" width="48" contentClasses="py-2 bg-gray-100">
                                        <template #trigger>
                                            <div
                                                class="mt-1 px-4 py-2 rounded-md border-2 bg-white text-gray-600 block w-full">
                                                {{ selectedRole || 'Select Role' }}</div>

                                        </template>
                                        <template #content>
                                            <ul>
                                                <li v-for="role in roles" :key="role"
                                                    @click="selectRole(role.id, role.name)"
                                                    class="cursor-pointer hover:bg-gray-200">{{ role.name }}</li>
                                            </ul>
                                        </template>
                                    </Dropdown>


                                </div>
                            </div>

                            <div>
                                <InputLabel for="description" value="Job description" />

                                <TextInput id="description" type="text" class="mt-1 block w-full"
                                    v-model="form.description" />

                                <InputError class="mt-2" :message="form.errors.description" />
                            </div>
                            <div>
                                <InputLabel for="description" value="Job requirements" />

                                <TextInput id="description" type="text" class="mt-1 block w-full"
                                    v-model="form.requirements" />

                                <InputError class="mt-2" :message="form.errors.requirements" />
                            </div>
                            <div class="flex flex-row">
                                <div class="w-1/2 mr-2">
                                    <InputLabel for="description" value="Available head counts" />

                                    <TextInput id="description" type="text" class="mt-1 block w-full"
                                        v-model="form.count" />

                                    <InputError class="mt-2" :message="form.errors.count" />
                                </div>
                                <div class="w-1/2">
                                    <InputLabel for="description" value="Basic salary" />

                                    <TextInput id="description" type="text" class="mt-1 block w-full"
                                        v-model="form.basic_salary" />

                                    <InputError class="mt-2" :message="form.errors.basic_salary" />
                                </div>
                            </div>

                            <div class="flex flex-row">
                                <div class="w-1/2 mr-2">
                                    <InputLabel for="joining" value="Estimated Joining Date" />

                                    <TextInput id="joining" type="date" class="mt-1 block w-full"
                                        v-model="form.joining_date" />

                                    <InputError class="mt-2" :message="form.errors.joining_date" />
                                </div>
                                <div class="w-1/2">
                                    <InputLabel for="description" value="Joining Port" />

                                    <TextInput id="description" type="text" class="mt-1 block w-full"
                                        v-model="form.port" />

                                    <InputError class="mt-2" :message="form.errors.port" />
                                </div>
                            </div>


                            <div class="flex justify-center">
                                <PrimaryButton class="my-5" :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing">
                                    Create New Job
                                </PrimaryButton>
                            </div>


                        </form>
                    </div>



                </div>
                <div class="mt-3" v-show="jobs.data.length <= 0">
                    <h1 class="text-center text-red-500 font-bold text-2xl">There is no available jobs!
                    </h1>
                </div>
                <div v-show="jobs.data.length > 0">
                    <div class="overflow-x-auto">
                        <div class="flex flex-row justify-between min-w-xl w-lg my-5">
                            <h1 class="text-xl text-center lg:ms-28 md:ms-4"> Jobs </h1>
                            <input type="text" v-model="search" class="rounded-md border-slate-400 lg:me-28 md:me-4"
                                name="search" placeholder="search.....">
                        </div>

                        <table class="mx-auto divide-y-2 divide-gray-200 bg-white text-sm">
                            <thead class="ltr:text-left rtl:text-right">
                                <tr>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Vessle Name</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Role</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Head Count</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Estimated Joining Date</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Joining Port</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Basic Salary</th>
                                    <th class="px-4 py-2"></th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                <tr v-for="job in jobs.data" :key="job.id">
                                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{
                            job.vessel.name }}
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ job.role.name }}</td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ job.count }}</td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ job.joining_date }}</td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ job.port }}</td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ job.basic_salary }} USD</td>

                                    <td class="whitespace-nowrap px-4 py-2">
                                        <a :href="route('jobs.edit', job)"
                                            class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700">
                                            View
                                        </a>
                                    </td>
                                </tr>


                            </tbody>
                        </table>
                        <div class="flex justify-end lg:me-24" v-if="jobs.links.length > 0">
                            <ul class="flex">
                                <li class="mr-2" v-for="link in jobs.links" :key="link.label">
                                    <a :href="link.url" v-html="link.label"></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>



            </div>





        </div>

    </AuthenticatedLayout>
</template>
