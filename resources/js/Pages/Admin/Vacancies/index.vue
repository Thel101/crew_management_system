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
            type: Array
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
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="max-w-lg mx-auto">
                        <form @submit.prevent="submit">
                            <div class="flex flex-row justify-between">
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
                            </div>
                            <div class="flex flex-row justify-between mt-4">
                                <div>
                                    <InputLabel for="description" value="Vacancy description" />

                                    <TextInput id="description" type="text" class="mt-1 block w-full"
                                        v-model="form.description" />

                                    <InputError class="mt-2" :message="form.errors.description" />
                                </div>


                            </div>


                            <div class="flex justify-center">
                                <PrimaryButton class="my-5" :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing">
                                    Create New Role
                                </PrimaryButton>
                            </div>


                        </form>
                        <h1 class="text-xl font-bold text-center">Vacancies</h1>
                    </div>

                    <div class="flex justify-center">
                        <table class="table-auto border border-gray-500 w-1/2 bg-slate-300">
                            <thead>
                                <tr>
                                    <th class="border border-slate-700">Vessel</th>
                                    <th class="border border-slate-700">Role</th>
                                    <th class="border border-slate-700">Description</th>
                                    <th class="border border-slate-700">Availabilty</th>
                                    <th class="border border-slate-700">Status</th>
                                    <th class="border border-slate-700">Actions</th>
                                </tr>

                            </thead>
                            <tbody>
                                <tr v-for="vacancy in vacancies" :key="vacancy.id">
                                    <TableCell>{{ vacancy.role.name }}</TableCell>
                                    <TableCell>{{ vacancy.vessel.name }}</TableCell>
                                    <TableCell>{{ vacancy.description }}</TableCell>
                                    <TableCell>{{ vacancy.availability }}</TableCell>
                                    <TableCell>{{ vacancy.status }}</TableCell>

                                    <TableCell>
                                        <div class="flex flex-row justify-start">
                                            <Link href="#" class="me-2 text-blue-400 font-bold hover:text-blue-700">View
                                            </Link>
                                            <Link href="#" class="me-3 text-red-400 font-bold hover:text-red-700">
                                            Deactivate</Link>

                                        </div>
                                    </TableCell>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>



            </div>



        </div>

    </AuthenticatedLayout>
</template>
