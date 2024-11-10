<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, watch, computed } from 'vue';
import Modal from '@/Components/Modal.vue';
const props = defineProps({
    seafarers: {
        type: Object
    },

})
const search = ref(''), pageNumber = ref(0)

let seafarerUrl = computed(() => {
    let url = new URL(route("seafarer.list"))
    url.searchParams.append("pageNumber", pageNumber.value)
    if (search.value) {
        url.searchParams.append("search", search.value)
    }
    return url;
});

watch(seafarerUrl, newUrl => {
    router.visit(newUrl, {
        preserveState: true,
        preserveScroll: true,
        replace: true
    })
})
const showModal = ref(false);
const modalTitle = ref('');
const modalMessage = ref('');
const delete_id = ref('')
const deleteSeafarer = (id) => {
    showModal.value = true
    modalTitle.value = 'Delete Seafarer'
    modalMessage.value = 'Are you sure you want to delete this seafarer?'
    delete_id.value = id
    console.log(delete_id.value)
}
const closeModal = () => {
    if (delete_id.value) {
        router.delete(route('seafarer.delete', { id: delete_id.value }))
    }
    showModal.value = false
    delete_id.value = ''
    deleteSuccessModal()

}
const deleteMessageShow = ref(false)
const deleteSuccessModal = () => {
    deleteMessageShow.value = true

}
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Seafarers</h2>
        </template>

        <div class="py-12">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">

                <div class="overflow-x-auto max-w-5xl mx-auto">
                    <div v-show="seafarers.data.length < 1" class="text-center text-red-400 font-bold text-2xl">There
                        is no
                        seafarers!</div>
                    <div v-if="deleteMessageShow"
                        class="max-w-lg mx-auto bg-green-300 flex flex-row justify-between p-3 rounded-md my-2">
                        <span>Seafarer has been successfully removed from the system!</span>
                        <button @click="deleteMessageShow = !deleteMessageShow"><svg xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg></button>

                    </div>


                    <div class="flex justify-end me-9" v-show="seafarers.data.length > 0">
                        <input type="text" v-model="search" placeholder="Search..." class=" border-slate-400 mb-4">
                    </div>
                    <table v-if="seafarers.data.length > 0" class="mx-auto divide-y-2 divide-gray-200 bg-white text-sm">
                        <thead class="ltr:text-left rtl:text-right">
                            <tr>

                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">ID</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Name</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Email</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Passport</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Passport Expiry Date
                                </th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Seaman book</th>

                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"></th>

                                <th class="px-4 py-2"></th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            <tr v-for="seafarer in seafarers.data" :key="seafarer.formatted_id">
                                <td v-show="seafarer.passport_status === 'warning'"><svg
                                        v-show="seafarer.passport_status === 'warning'"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6 text-yellow-300">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                    </svg></td>
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                    {{ seafarer.formatted_id }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                    {{ seafarer.fullname }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ seafarer.email }}</td>

                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{
                                    seafarer.passport[0].passport_no
                                    }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{
                                    seafarer.passport[0].expiry_date
                                    }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{
                                    seafarer.seaman_book
                                    }}
                                </td>


                                <td class="whitespace-nowrap px-4 py-2">
                                    <a :href="route('seafarer.detail', seafarer.id)"
                                        class="inline-block rounded bg-indigo-600 px-4 py-2 mx-2 text-xs font-medium text-white hover:bg-indigo-700">
                                        View
                                    </a>
                                    <button @click="deleteSeafarer(seafarer.id)"
                                        class="inline-block rounded bg-red-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700">
                                        Delete
                                    </button>
                                </td>
                            </tr>


                        </tbody>
                    </table>

                    <div v-if="seafarers.data.length > 0" class="max-w-4xl mx-auto flex justify-end">
                        <ul class="flex">
                            <li class="mr-2" v-for="link in seafarers.links" :key="link.label">
                                <a :href="link.url" v-html="link.label"></a>
                            </li>
                        </ul>
                    </div>
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
        </div>
    </AuthenticatedLayout>
</template>
