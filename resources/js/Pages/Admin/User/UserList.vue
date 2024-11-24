<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import { ref } from 'vue';
import Modal from '@/Components/Modal.vue';
const props = defineProps({
    users:
    {
        type: Object
    }
})
const form = useForm({
    name: '',
    email: '',
    role: 'staff',
    password: ''
})
const showModal = ref(false)
const modalTitle = ref('')
const modalMessage = ref('')
const closeModal = () => {
    showModal.value = false
}
const submit = () => {
    form.post(route('users.store'), {
        onSuccess: () => {
            form.reset()
            showModal.value = true
            modalTitle.value = 'User Created'
            modalMessage.value = 'User has been created successfully'
        }
    })
}
const changeRole = (user) => {
    router.patch(route('users.update', user), {
        onSuccess: () => {
            console.log('success')
            showModal.value = true
            modalTitle.value = 'Role Changed'
            modalMessage.value = 'User role has been changed successfully'

        }
    })
}

</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>
        </template>

        <div class="py-12">

            <div class="max-w-lg mx-auto bg-white shadow sm:rounded-lg p-3 mb-5">
                <h1 class="text-center text-xl font-semibold mb-5 mt-3">Create New User</h1>
                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="name" value="User Name" />

                        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="description" value="User email address" />

                        <TextInput id="description" type="text" class="mt-1 block w-full" v-model="form.email" />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                    <div class="flex justify-center">
                        <PrimaryButton class="mt-5 mb-3" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">
                            Create New User
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
                                        <a v-show="user.role == 'admin' && user.id != $page.props.auth.user.id"
                                            @click="changeRole(user)"
                                            class="inline-block rounded bg-red-500 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700">
                                            Remove Admin
                                        </a> <a v-show="user.role == 'staff'" @click="changeRole(user)"
                                            class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700">
                                            Assign Admin
                                        </a>
                                    </td>
                                </tr>


                            </tbody>
                        </table>
                    </div>

                </div>



            </div>
            <div class="max-w-4xl mt-4 flex justify-end lg:me-24" v-if="users.links.length > 0">
                <ul class="flex">
                    <li class="mr-2" v-for="link in users.links" :key="link.label">
                        <a :href="link.url" v-html="link.label"></a>
                    </li>
                </ul>
            </div>
        </div>
        <template>
            <Modal :show="showModal" :closeable="true" class="max-w-md" @close="closeModal">
                <div class="p-4 bg-green-200">
                    <h2 class="text-lg font-bold">{{ modalTitle }}</h2>
                    <p>{{ modalMessage }}</p>
                    <div class="flex flex-row justify-end">
                        <button @click="closeModal"
                            class="bg-gray-300 rounded-md border-2 border-slate-300 px-3 py-2 mt-4">Close</button>
                    </div>
                </div>
            </Modal>
        </template>
    </AuthenticatedLayout>
</template>
