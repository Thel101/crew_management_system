<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
const props = defineProps
    ({
        job: {
            type: Object
        }
    })

const form = useForm({
    role_id: props.job.role_id,
    vessel_id: props.job.vessel_id,
    description: props.job.description,
    count: '',
    requirements: '',
    joining_date: '',
    port: '',
    basic_salary: '',

});

const submit = () => {
    form.patch(route('jobs.update', props.job));
};
</script>
<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Roles</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <div class="max-w-2xl mx-auto bg-white shadow sm:rounded-lg p-2 px-5">
                        <h1 class="text-xl font-bold text-center mb-5 mt-3">Update Job</h1>
                        <form @submit.prevent="submit">

                            <div class="flex flex-row">
                                <div class="w-1/2 mr-2">
                                    <InputLabel for="name" value="Vessel" />

                                    <TextInput v-model="job.vessel.name" disabled/>
                                </div>
                                <div class="w-1/2">
                                    <InputLabel for="role" value="Role" />

                                    <TextInput v-model="job.role.name" disabled/>

                                </div>
                            </div>

                            <div>
                                <InputLabel for="description" value="Job description" />

                                <TextInput id="description" type="text" class="mt-1 block w-full"
                                    v-model="form.description" />

                                <InputError class="mt-2" :message="form.errors.description" />
                            </div>
                            <div>
                                <InputLabel for="requirements" value="Job requirements" />

                                <TextInput id="requirements" type="text" class="mt-1 block w-full"
                                    v-model="form.requirements" />

                                <InputError class="mt-2" :message="form.errors.requirements" />
                            </div>
                            <div class="flex flex-row">
                                <div class="w-1/2 mr-2">
                                    <InputLabel for="count" value="Available head counts" />

                                    <TextInput id="count" type="text" class="mt-1 block w-full"
                                        v-model="form.count" />

                                    <InputError class="mt-2" :message="form.errors.count" />
                                </div>
                                <div class="w-1/2">
                                    <InputLabel for="salary" value="Basic salary" />

                                    <TextInput id="salary" type="text" class="mt-1 block w-full"
                                        v-model="form.basic_salary" />

                                    <InputError class="mt-2" :message="form.errors.basis_salary" />
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
                                    <InputLabel for="port" value="Joining Port" />

                                    <TextInput id="port" type="text" class="mt-1 block w-full"
                                        v-model="form.port" />

                                    <InputError class="mt-2" :message="form.errors.port" />
                                </div>
                            </div>


                            <div class="flex justify-center">
                                <PrimaryButton class="my-5" :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing">
                                    Update Job
                                </PrimaryButton>
                            </div>


                        </form>
                    </div>

                </div>


            </div>

        </div>
    </AuthenticatedLayout>
</template>
