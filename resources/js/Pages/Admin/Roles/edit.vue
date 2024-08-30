<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    role: {
        type: Array
    }
})
const form = useForm({
    name: props.role.name,
    description: props.role.description
})
const submit = ()=>{
    form.patch(route('roles.update', props.role))

}
</script>
<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Roles</h2>
        </template>

        <div class="max-w-lg mx-auto bg-white shadow sm:rounded-lg p-3 mb-5 mt-7">
            <h1 class="text-center text-xl font-semibold mb-5 mt-3">Update Role</h1>
            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="name" value="Role Name" />

                    <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="mt-4">
                    <InputLabel for="description" value="Role Brief Description" />

                    <TextInput id="description" type="text" class="mt-1 block w-full" v-model="form.description" />

                    <InputError class="mt-2" :message="form.errors.description" />
                </div>
                <div class="flex justify-center">
                    <PrimaryButton class="mt-5 mb-3" :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing">
                        Create New Role
                    </PrimaryButton>
                </div>


            </form>
        </div>
    </AuthenticatedLayout>
</template>
