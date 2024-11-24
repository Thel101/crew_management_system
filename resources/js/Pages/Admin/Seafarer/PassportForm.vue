<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { ref } from 'vue';
import { useForm, usePage, router } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
const props = defineProps({
    'passport': {
        type: Object,
    },
    'seafarer': {
        type: Object,
    },
})
const form = useForm({
    seafarer_id: props.passport.seafarer_id,
    passport_no: props.passport.passport_no,
    place_of_issue: props.passport.place_of_issue,
    issue_date: props.passport.issue_date,
    expiry_date: props.passport.expiry_date,
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
    form.patch(route('passport.update', props.passport), {
        onSuccess: () => {
            showModal.value = true
            modalTitle.value = 'Update Success'
            modalMessage.value = page.props.flash.message

        }
    })
}
const Back = () => {
    history.back()
    window.addEventListener('popstate', () => {
        location.reload();
    });
}
</script>
<template>
    <AuthenticatedLayout>
        <a href="#" class="ms-6 text-blue-600 text-lg underline" @click="Back">Back</a>
        <form @submit.prevent="submit">
            <div class="p-5 bg-white rounded-md border-slate-500 shadow-md m-5 max-w-5xl">
                <div class="text-lg font-semibold">
                    Seafarer Name : {{ props.seafarer.fullname }}
                </div>
                <div class="text-lg font-semibold">
                    ID: {{ props.seafarer.formatted_id }}
                </div>
                <div v-if="props.seafarer.status == 'new'" class=" text-lg font-semibold">
                    Onboarding: <span>Not yet</span>
                </div>
                <div v-else class=" text-lg font-semibold">
                    Onboarding: <span>Yes</span>
                </div>
                <div class="flex flex-row">
                    <div class="w-1/4">

                        <InputLabel for="passport_no">Passport No:</InputLabel>
                        <TextInput id="passport_no" type="text" class="mt-1 block w-full" v-model="form.passport_no" />
                        <InputError class="mt-2" :message="form.errors.passport_no" />
                    </div>
                    <div class="w-1/4">
                        <InputLabel for="place_of_issue">Place of issue</InputLabel>
                        <TextInput id="place_of_issue" type="text" class="mt-1 block w-full"
                            v-model="form.place_of_issue" />
                        <InputError class="mt-2" :message="form.errors.place_of_issue" />
                    </div>
                    <div class="w-1/4">
                        <InputLabel for="issue_date">Issue date</InputLabel>
                        <TextInput id="issue_date" :max="today" type="date" class="mt-1 block w-full"
                            v-model="form.issue_date" />
                        <InputError class="mt-2" :message="form.errors.issue_date" />

                    </div>
                    <div class="w-1/4">
                        <InputLabel for="expiry_date">Expiry Date</InputLabel>
                        <TextInput id="expiry_date" type="date" :max="maxDate" class="mt-1 block w-full"
                            v-model="form.expiry_date" />
                        <InputError class="mt-2" :message="form.errors.expiry_date" />
                    </div>
                </div>
                <PrimaryButton class="mt-4">Update Passport</PrimaryButton>

            </div>
        </form>

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
