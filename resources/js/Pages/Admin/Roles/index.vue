<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage, router } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref, watch, computed } from 'vue';
import Modal from '@/Components/Modal.vue';
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
const showModal = ref(false)
const modalTitle = ref('')
const modalMessage = ref('')
const closeModal = () => {
    showModal.value = false
    router.get(route('roles.index'))
}
const submit = () => {
    form.post(route('roles.store'), {
        onSuccess: () => {
            form.reset()
            showModal.value = true
            modalTitle.value = 'Role Created'
            modalMessage.value = "New role has been created successfully!"

        }
    });
};
const search = ref(''), pageNumber = ref(0)

let roleUrl = computed(() => {
    let url = new URL(route("roles.index"))
    url.searchParams.append("pageNumber", pageNumber.value)
    if (search.value) {
        url.searchParams.append("search", search.value)
    }
    return url;
});

watch(roleUrl, newUrl => {
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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Roles</h2>
        </template>

        <div class="py-12">

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


            <div v-show="roles.data.length <= 0">
                <h1 class="text-center text-red-500 font-bold text-2xl">There is no registered roles!</h1>
            </div>

            <div v-show="roles.data.length > 0" class="items-center justify-center">

                <div class="max-w-5xl mx-auto flex flex-row justify-between my-5">
                    <h1 class="text-xl font-bold text-center lg:ms-20 md:ms-4"> Roles </h1>
                    <input type="text" v-model="search" class="rounded-md border-slate-400 lg:me-20 md:me-4"
                        name="search" placeholder="search.....">
                </div>
                <div class="max-w-4xl mx-auto">
                    <table v-show="roles.data.length > 0"
                        class="ml-6 mr-20 divide-y-2 divide-gray-200 bg-white text-sm table-fixed w-full">

                        <thead class="ltr:text-left rtl:text-right">
                            <tr>
                                <th class="w-1/6 px-4 py-2 font-medium text-gray-900">Name</th>
                                <th class="w-4/6 px-4 py-2 font-medium text-gray-900">Description</th>

                                <th class="w-1/6 px-4 py-2"></th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            <tr v-for="role in roles.data" :key="role.id">
                                <td class="px-4 py-2 font-medium text-gray-900">{{ role.name }}
                                </td>
                                <td class="px-4 py-2 text-gray-700 w-40">
                                    {{
                                        role.description }}</td>

                                <td class="whitespace-nowrap px-4 py-2">
                                    <a :href="route('roles.edit', role)"
                                        class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700">
                                        Edit
                                    </a>

                                </td>
                            </tr>


                        </tbody>
                    </table>
                </div>

            </div>
            <div class="max-w-4xl mx-auto flex mt-5 justify-end" v-show="roles.data.length > 0">
                <ul class="flex">
                    <li class="mr-2" v-for="link in roles.links" :key="link.label">
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
