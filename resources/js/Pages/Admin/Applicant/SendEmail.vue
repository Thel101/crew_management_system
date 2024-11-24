<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
const form = useForm({
    email: '',
    body: '',
    file: ''
})
const file = (event) => {
    form.file = event.target.files[0]
}
const showModal = ref(false);
const modalTitle = ref('');
const modalMessage = ref('');
const closeModal = () => {
    showModal.value = false
}
const submit = () => {
    form.post(route('send.cv'), {
        onSuccess: () => {
            showModal.value = true
            modalTitle.value = 'Successful Email'
            modalMessage.value = 'CV has been sent to email successfully'
            form.reset()
            form.file = ''
        }
    })
}
</script>
<template>
    <AuthenticatedLayout>
        <a :href="route('applicants.list')" class="ms-7 text-blue-600 text-lg underline">Back to Applicant List</a>
        <div class="p-5 bg-white rounded-md border-slate-500 shadow-md m-5 max-w-5xl">
            <h1>Sending Email Applicant CV</h1>
            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="recipient">Recipient Email Address</InputLabel>
                    <TextInput id="recipient" type="email" class="mt-1 block w-full" v-model="form.email" />
                </div>
                <div>
                    <InputLabel for="body">Email Content</InputLabel>
                    <TextInput id="body" type="text" class="mt-1 block w-full" v-model="form.body" />
                </div>
                <div>
                    <input class="my-2" type="file" accept=".pdf" @change="file($event)">
                </div>
                <PrimaryButton>Send</PrimaryButton>
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
