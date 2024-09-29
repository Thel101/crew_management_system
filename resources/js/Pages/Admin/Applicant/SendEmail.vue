<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
const form = useForm({
    email : '',
    body: '',
    file : ''
})
const file = (event) =>{
   form.file = event.target.files[0]
}
const submit = ()=>{
    form.post(route('send.cv'), {
        onSuccess: ()=>{
            console.log('Email Sent Successfully!')
        }
    })
}
</script>
<template>
    <AuthenticatedLayout>
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
            <input type="file" @change="file($event)">
        </div>
        <PrimaryButton>Send</PrimaryButton>
    </form>
    </AuthenticatedLayout>
</template>
