<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TableCell from '@/Components/TableCell.vue';
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
        vacancies: {
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
const form = useForm({
    role_id: '',
    vessel_id: '',
    description: '',
    requirements: '',
    availability: '',
});

const submit = () => {
    form.post(route('vacancies.store'), {
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
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <div class="max-w-lg mx-auto shadow-sm sm:rounded-lg bg-slate-200 p-2 px-5">
                        <h1 class="text-xl font-bold text-center mb-5 mt-3">Create New Vacancy</h1>
                        <form @submit.prevent="submit">

                            <div>
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
                            <div>
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

                            <div>
                                <InputLabel for="availability" value="Availabile vacancy count" />

                                <TextInput id="availability" type="number" class="mt-1 block w-full"
                                    v-model="form.availability" />

                                <InputError class="mt-2" :message="form.errors.availability" />
                            </div>

                            <div>
                                <InputLabel for="description" value="Vacancy description" />

                                <TextInput id="description" type="text" class="mt-1 block w-full"
                                    v-model="form.description" />

                                <InputError class="mt-2" :message="form.errors.description" />
                            </div>
                            <div>
                                <InputLabel for="requirement" value="Vacancy requirements" />

                                <TextInput id="requirement" type="text" class="mt-1 block w-full"
                                    v-model="form.requirements" />

                                <InputError class="mt-2" :message="form.errors.requirements" />
                            </div>

                            <div class="flex justify-center">
                                <PrimaryButton class="my-5" :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing">
                                    Create New Vacancy
                                </PrimaryButton>
                            </div>


                        </form>
                    </div>



                </div>




            </div>
            <div class="mt-3" v-show="vacancies.data.length <= 0">
                <h1 class="text-center text-red-500 font-bold text-2xl">There is no available vacancies!
                </h1>
            </div>
            <div v-show="vacancies.data.length > 0" class="max-w-3xl mx-auto">

                <div class="w-full flex flex-row justify-between">
                    <h1 class="text-xl font-bold text-center">Vacancies</h1>
                    <input class="rounded-md" placeholder="search...." type="text" name="" id="">
                </div>

                <table class="w-full divide-y-2 divide-gray-200 bg-white text-sm">
                    <thead class="ltr:text-left rtl:text-right">
                        <tr>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Vessle Name</th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Role</th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Availability</th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Description</th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Requirements</th>

                            <th class="px-4 py-2"></th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        <tr v-for="vacancy in vacancies.data" :key="vacancy.id">
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{
                            vacancy.vessel.name }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ vacancy.role.name }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ vacancy.availability }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ vacancy.description }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ vacancy.requirements }}
                            </td>

                            <td class="whitespace-nowrap px-4 py-2">
                                <a href="#"
                                    class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700">
                                    View
                                </a>
                            </td>
                        </tr>


                    </tbody>
                </table>
                <div class="w-full flex flex-row justify-end" v-if="vacancies.links.length > 0">
                    <ul class="flex">
                        <li class="mr-2" v-for="link in vacancies.links" :key="link.label">
                            <a :href="link.url" v-html="link.label"></a>
                        </li>
                    </ul>
                </div>
            </div>




        </div>

    </AuthenticatedLayout>
</template>
