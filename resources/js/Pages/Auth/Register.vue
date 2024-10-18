<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import { Inertia } from '@inertiajs/inertia';
import { ref } from 'vue';

const page = usePage();
const props = defineProps({
    message: {
        type: String
    },
    user: {
        type: Object
    }
})
const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});
const showModal = ref(false);
const closeModal = () => {
    showModal.value = false;
    const user_id = page.props.auth.user.id;
    Inertia.get(route('seafarer.profile', { id: user_id }));
}

const modalMessage = ref('');
const modalTitle = ref('');
const submit = () => {
    form.post(route('register'), {
        onSuccess: (page) => {

            form.reset();
            showModal.value = true;
            modalTitle.value = 'Registration Successful';
            modalMessage.value = page.props.flash.message;
        }
    });
};
</script>

<template>

    <Head title="Register" />
    <div class="md:w-80 md:px-0 px-2 md:mx-0 mt-4">
        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                    autocomplete="name" />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                    autocomplete="username" />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                    autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />

                <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                    v-model="form.password_confirmation" required autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Already registered?
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </div>
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
