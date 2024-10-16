<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Link } from '@inertiajs/vue3'
import Modal from '@/Components/Modal.vue'
import { ref } from 'vue';
const props = defineProps({
    leaves: {
        type: Object
    }
})

const showModal = ref(false);
const closeModal = () => {
    showModal.value = false
}
const modalMessage = ref('');
const modalTitle = ref('');

const handleSuccess = () => {
    showModal.value = true
    modalTitle.value = 'Leave Request Approval'
    modalMessage.value = 'Leave request has been approved'

}
</script>
<template>
    <AuthenticatedLayout>

        <div>
            <h2 class="font-semibold text-2xl text-center mt-8 text-gray-800 leading-tight">Leave Requests</h2>
            <table v-show="leaves.data.length > 0" class="mx-auto my-8 divide-y-2 divide-gray-200 bg-white text-sm">

                <thead class="ltr:text-left rtl:text-right">
                    <tr>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Seafarer ID</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Seafarer Name</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Vessel</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Leave Start Date</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Leave End Date</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Reason</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Days</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Status</th>


                        <th class="px-4 py-2"></th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    <tr v-for="leave in leaves.data" :key="leave.id">
                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ leave.seafarer.formatted_id
                            }}
                        </td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ leave.seafarer.fullname }}</td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ leave.seafarer.vessel.name }}</td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ leave.leave_start }}</td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ leave.leave_end }}</td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ leave.reason }}</td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ leave.count }}</td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ leave.status }}</td>

                        <td class="whitespace-nowrap px-4 py-2">
                            <Link v-show="leave.status == 'pending'" as="button" method="patch"
                                :href="route('leave.update', leave)" @success="handleSuccess"
                                class="inline-block rounded bg-green-400 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700">
                            Approve
                            </Link>

                        </td>
                    </tr>


                </tbody>
            </table>
        </div>
        <template>
            <Modal :show="showModal" :closeable="true" @close="closeModal">
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
