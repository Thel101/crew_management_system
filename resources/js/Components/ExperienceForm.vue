<script setup>

import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue'
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { ref } from 'vue';
import { useForm, usePage, router, Link } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
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

    <div class="p-5 bg-white rounded-md border-slate-500 shadow-md m-5 max-w-5xl">

        <form @submit.prevent="submit">
            <div class="flex flex-row">
                <div class="w-1/3 mr-3">
                    <InputLabel for="ship_name">Ship Name</InputLabel>
                    <TextInput id="ship_name" type="text" class="mt-1 block w-full" v-model="form.ship_name" />
                    <InputError>{{ form.errors.ship_name }}</InputError>
                </div>
                <div class="w-1/3 mr-3">
                    <InputLabel for="flag">Ship Flag</InputLabel>
                    <TextInput id="flag" type="text" class="mt-1 block w-full" v-model="form.flag" />
                    <InputError>{{ form.errors.flag }}</InputError>
                </div>
                <div class="w-1/3">
                    <InputLabel for="type">Ship Type</InputLabel>
                    <TextInput id="type" type="text" class="mt-1 block w-full" v-model="form.ship_type" />
                    <InputError>{{ form.errors.ship_type }}</InputError>
                </div>
            </div>
            <div class="flex flex-row">

                <div class="w-1/3 mr-3">
                    <InputLabel for="rank">Rank</InputLabel>
                    <TextInput id="rank" type="text" class="mt-1 block w-full" v-model="form.rank" />
                    <InputError>{{ form.errors.rank }}</InputError>
                </div>
                <div class="w-1/3 mr-3">
                    <InputLabel for="grt">Ship GRT</InputLabel>
                    <TextInput id="grt" type="text" class="mt-1 block w-full" v-model="form.GRT" />
                    <InputError>{{ form.errors.GRT }}</InputError>
                </div>
                <div class="w-1/3">
                    <InputLabel for="trade">Trade</InputLabel>
                    <TextInput id="trade" type="text" class="mt-1 block w-full" v-model="form.trade" />
                    <InputError>{{ form.errors.trade }}</InputError>
                </div>
            </div>

            <div class="flex flex-row">
                <div class="w-1/3 mr-3">
                    <InputLabel for="sign_on">Sign On Date</InputLabel>
                    <TextInput id="sign_on" type="date" class="mt-1 block w-full" v-model="form.sign_on_date" />
                    <InputError>{{ form.errors.flag }}</InputError>
                </div>
                <div class="w-1/3">
                    <InputLabel for="sign_off">Sign Off Date</InputLabel>
                    <TextInput id="sign_off" type="date" class="mt-1 block w-full" v-model="form.sign_off_date" />
                    <InputError>{{ form.errors.flag }}</InputError>
                </div>
            </div>

            <div class="flex flex-row gap-2">
                <PrimaryButton class="my-2">Update Experience</PrimaryButton>
                <PrimaryButton v-if="$page.props.auth.user.role != 'user'" class="my-2">
                    <Link :href="route('seafarer.detail', experience.seafarer_id)">Cancel</Link>
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

</template>
