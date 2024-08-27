<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';

const props = defineProps({
    users:
    {
        type: Array
    }
})
const form = useForm({
    name: '',
    email: '',
    password: ''
})

const submit =()=>{

}
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>
        </template>

        <div class="py-12">

            <div class="max-w-lg mx-auto bg-slate-200 rounded-md p-3 mb-5">
                <h1 class="text-center text-xl font-semibold mb-5 mt-3">Create New User</h1>
                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="name" value="Role Name" />

                        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name"
                            autofocus />

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

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <div v-show="users.data.length < 0" class="text-center text-red-400 font-bold text-2xl">There is no
                        applicants!</div>
                    <div v-show="users.data.length > 0" class="overflow-x-auto">
                        <table class="mx-auto divide-y-2 divide-gray-200 bg-white text-sm">
                            <thead class="ltr:text-left rtl:text-right">
                                <tr>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Name</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Email</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Role</th>

                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"></th>

                                    <th class="px-4 py-2"></th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                <tr v-for="user in users.data" :key="user.id">
                                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{
                        user.name }}
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ user.email }}</td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ user.role }}
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
                        <div class="flex justify-end lg:me-24" v-if="users.links.length > 0">
                            <ul class="flex">
                                <li class="mr-2" v-for="link in users.links" :key="link.label">
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
