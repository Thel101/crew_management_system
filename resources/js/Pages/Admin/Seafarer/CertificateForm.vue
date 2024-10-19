<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue'
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { ref } from 'vue';
import { useForm, usePage, router, Link } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
const props = defineProps({
    'certificate': {
        type: Object,
    }
})
const form = useForm({
    name: props.certificate.name,
    certificate_no: props.certificate.certificate_no,
    issue_date: props.certificate.issue_date,
    expiry_date: props.certificate.expiry_date,
    issuing_authority: props.certificate.issuing_authority,
})
const showModal = ref(false)
const modalTitle = ref('')
const modalMessage = ref('')
const closeModal = () => {
    showModal.value = false
    router.get(route('seafarer.detail', props.certificate.seafarer_id))
}

const page = usePage()
const submit = () => {
    form.patch(route('certificates.update', props.certificate), {
        onSuccess: () => {
            showModal.value = true
            modalTitle.value = 'Update Success'
            modalMessage.value = page.props.flash.message

        }
    })
}
</script>
<template>
    <AuthenticatedLayout>
        <div class="p-5 bg-white rounded-md border-slate-500 shadow-md m-5 max-w-5xl">
            <h1 class="text-2xl font-bold my-2">Seafarer Certificate</h1>
            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="cert_name">Certificate Name</InputLabel>
                    <TextInput id="cert_name" type="text" class="mt-1 block w-full" v-model="form.name" />
                    <InputError>{{ form.errors.name }}</InputError>
                </div>
                <div>
                    <InputLabel for="cert_no">Certificate Number</InputLabel>
                    <TextInput id="cert_no" type="text" class="mt-1 block w-full" v-model="form.certificate_no" />
                </div>
                <div>
                    <InputLabel for="authority">Issuing Authority</InputLabel>
                    <TextInput id="authority" type="text" class="mt-1 block w-full" v-model="form.issuing_authority" />
                </div>
                <div>
                    <InputLabel for="issue_date">Certificate Issue Date</InputLabel>
                    <TextInput id="issue_date" type="date" class="mt-1 block w-full" v-model="form.issue_date" />
                </div>
                <div>
                    <InputLabel for="expiry_date">Certificate Expiry Date</InputLabel>
                    <TextInput id="expiry_date" type="date" class="mt-1 block w-full" v-model="form.expiry_date" />
                </div>
                <!-- <div>
                    <InputLabel for="cert_image">Certificate Image</InputLabel>
                    <input type="file" accept=".pdf,.docx" @change="file($event)">
                </div> -->

                <div class="flex flex-row">
                    <PrimaryButton class="my-2">Update Certificate</PrimaryButton>
                    <PrimaryButton class="my-2">
                        <Link :href="route('seafarer.detail', certificate.seafarer_id)">Cancel</Link>
                    </PrimaryButton>
                </div>

            </form>
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
