<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { ref } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
import Modal from '@/Components/Modal.vue';
const props = defineProps({
    seafarer: {
        type: Object
    },
    jobs: {
        type: Array
    }
})
const fullname = ref(props.seafarer.fullname)
const form = useForm({
    user_id: props.seafarer.id,
    role_id: props.seafarer.role_id,
    vessel_id: ''
})
const selectedVessel = ref('')
const selectVessel = (job) => {
    selectedVessel.value = job.vessel.name
    form.vessel_id = job.vessel.id
}

const showModal = ref(false);
const modalTitle = ref('');
const modalMessage = ref('');
const closeModal = () => {
    showModal.value = false
    router.visit(route('applicants.list'))
}
const submit = () => {
    form.patch(route('applicant.status'), {
        onSuccess: () => {
            showModal.value = true
            modalTitle.value = 'Successful Assign'
            modalMessage.value = 'Seafarer has been successfully assigned to the vessel'
        }
    })
}
</script>
<template>
    <AuthenticatedLayout>
        <div class="p-5 bg-white rounded-md border-slate-500 shadow-md m-5 max-w-5xl">
            <h1>Assign Seafarer to Vessel</h1>
            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="recipient">Assigning Seafarer</InputLabel>
                    <TextInput id="recipient" type="text" class="mt-1 block w-full" v-model="fullname" />
                    <input type="hidden" v-model="form.user_id">
                </div>
                <div>
                    <InputLabel for="body">Assigned Role</InputLabel>
                    <TextInput id="body" type="text" class="mt-1 block w-full" v-model="props.seafarer.role.name" />
                    <input type="hidden" v-model="form.role_id" />
                </div>
                <InputLabel for="body">Assigned Vessel</InputLabel>
                <Dropdown align="left" width="48" contentClasses="py-2 bg-gray-100">
                    <template #trigger>
                        <div class="mt-1 px-4 py-2 rounded-md border-2 bg-white text-gray-600 block w-full">
                            {{ selectedVessel || 'Select Vessel' }}</div>

                    </template>
                    <template #content>
                        <ul class="px-2">
                            <li v-for="job in props.jobs" :key="job.id" @click="selectVessel(job)"
                                class="cursor-pointer hover:bg-gray-200">
                                {{ job.vessel.name }}</li>
                        </ul>
                    </template>
                </Dropdown>


                <PrimaryButton class="my-2">Send</PrimaryButton>
            </form>
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
