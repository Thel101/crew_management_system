<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref } from 'vue';
defineProps({
    roles:
    {
        type: Object
    }
})
const form = useForm({
    name: '',
    description: ''
});
const page = usePage();

const clearFlashMessage = () => {
    page.props.flash.message = null
}
const submit = () => {
    form.post(route('roles.store'), {
        onSuccess: () => {
            form.reset()
            showMessage.value = true
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
                class="max-w-lg mx-auto bg-green-300 flex flex-row justify-between p-3 rounded-md my-2">
                <span>{{ $page.props.flash.message }}</span>
                <button @click="clearFlashMessage"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg></button>

            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <div class="max-w-lg mx-auto bg-white shadow sm:rounded-lg p-3 mb-5">
                        <h1 class="text-center text-xl font-semibold mb-5 mt-3">Create New Role</h1>
                        <form @submit.prevent="submit">
                            <div>
                                <InputLabel for="name" value="Role Name" />

                                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" />

                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="description" value="Role Brief Description" />

                                <TextInput id="description" type="text" class="mt-1 block w-full"
                                    v-model="form.description" />

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


                    <div v-show="roles.data.length <= 0">
                        <h1 class="text-center text-red-500 font-bold text-2xl">There is no registered roles!</h1>
                    </div>
                </div>
            </div>
            <div v-show="roles.data.length > 0" class="items-center justify-center">

                <div class="max-w-5xl mx-auto flex flex-row justify-between my-5">
                    <h1 class="text-xl text-center lg:ms-14 md:ms-4"> Roles </h1>
                    <input type="text" v-model="search" class="rounded-md border-slate-400 lg:me-14 md:me-4"
                        name="search" placeholder="search.....">
                </div>
                <div class="max-w-7xl mx-auto">
                    <table v-show="roles.data.length > 0" class="mx-auto divide-y-2 divide-gray-200 bg-white text-sm">

                        <thead class="ltr:text-left rtl:text-right">
                            <tr>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Name</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Description</th>

                                <th class="px-4 py-2"></th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            <tr v-for="role in roles.data" :key="role.id">
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ role.name }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ role.description }}</td>

                                <td class="whitespace-nowrap px-4 py-2">
                                    <a :href="route('roles.edit', role)"
                                        class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700">
                                        Edit
                                    </a>
                                    <a href="#"
                                        class="ms-2 inline-block rounded bg-red-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700">
                                        Delete
                                    </a>
                                </td>
                            </tr>


                        </tbody>
                    </table>
                </div>

                <div class="max-w-5xl mx-auto flex justify-end mt-5 me-5" v-show="roles.data.length > 0">
                    <ul class="flex">
                        <li class="mr-2" v-for="link in roles.links" :key="link.label">
                            <a :href="link.url" v-html="link.label"></a>
                        </li>
                    </ul>
                </div>
            </div>




        </div>

    </AuthenticatedLayout>
</template>
