<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { ref } from 'vue';
import { useForm, usePage, router } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import ExperienceForm from '@/Components/ExperienceForm.vue';
const props = defineProps({
    'experience': {
        type: Object,
    }
})
const form = useForm({
    ship_name: props.experience.ship_name,
    flag: props.experience.flag,
    ship_type: props.experience.ship_type,
    rank: props.experience.rank,
    GRT: props.experience.GRT,
    trade: props.experience.trade,
    sign_on_date: props.experience.sign_on_date,
    sign_off_date: props.experience.sign_off_date,
})
const showModal = ref(false)
const modalTitle = ref('')
const modalMessage = ref('')
const closeModal = () => {
    showModal.value = false
    router.get(route('seafarer.detail', props.experience.seafarer_id))
}

const page = usePage()
const submit = () => {
    form.patch(route('experiences.update', props.experience), {
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
            <h1 class="text-2xl font-bold my-2">Seafarer Experience</h1>
            <ExperienceForm :experience="props.experience"></ExperienceForm>
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
