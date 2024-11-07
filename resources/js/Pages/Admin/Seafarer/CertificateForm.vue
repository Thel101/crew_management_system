<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { ref } from 'vue';
import { useForm, usePage, router, Link } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import CertificateForm from '@/Components/CertificateForm.vue';
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
            <CertificateForm :certificate="props.certificate"></CertificateForm>
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
