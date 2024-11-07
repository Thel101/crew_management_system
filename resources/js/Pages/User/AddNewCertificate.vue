<script setup>
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue'
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { ref } from 'vue';
import { useForm, usePage, router, Link } from '@inertiajs/vue3';
import { defineEmits } from 'vue';
const props = defineProps({
    'seafarer_id': ''
})
console.log(props.seafarer_id)
const cert_img = ref([]);
const certificateImage = (e, index) => {
    const cert_file = e.target.files[0];
    if (cert_file) {
        const reader = new FileReader();
        reader.onload = (event) => {
            cert_img.value[index] = event.target.result;
            certificates.certificates[index].cert_image = cert_file;
        };
        reader.readAsDataURL(cert_file);
    }
};

const emit = defineEmits(['certificateAdded']);
const certificates = useForm({
    certificates: [
        {
            seafarer_id: props.seafarer_id,
            name: '',
            certificate_no: '',
            issue_date: '',
            expiry_date: '',
            issuing_authority: '',
            cert_image: '',
            existing: true
        }
    ]
})


const submit = () => {
    certificates.post(route('certificates.store'), {
        onSuccess: () => {
            emit('certificateAdded');
        }
    })
}

</script>
<template>

    <div class="p-5 bg-white rounded-md border-slate-500 shadow-md m-5 max-w-5xl">
        <div v-for="(certificate, index) in certificates.certificates" :key="index" class="flex flex-col gap-2 mt-2">
            <div class="flex flex-row">
                <div class="w-1/3 mr-2">
                    <InputLabel for="cert_name">Certificate Name</InputLabel>
                    <TextInput id="cert_name" type="text" class="mt-1 block w-full" v-model="certificate.name" />
                    <InputError>{{ certificate.errors.name }}</InputError>
                </div>
                <div class="w-1/3 mr-2">
                    <InputLabel for="cert_no">Certificate Number</InputLabel>
                    <TextInput id="cert_no" type="text" class="mt-1 block w-full"
                        v-model="certificate.certificate_no" />
                </div>
                <div class="w-1/3">
                    <InputLabel for="authority">Issuing Authority</InputLabel>
                    <TextInput id="authority" type="text" class="mt-1 block w-full"
                        v-model="certificate.issuing_authority" />
                </div>
            </div>
            <div class="flex flex-row">
                <div class="w-1/3 mr-2">
                    <InputLabel for="issue_date">Certificate Issue Date</InputLabel>
                    <TextInput id="issue_date" type="date" class="mt-1 block w-full" v-model="certificate.issue_date" />
                </div>
                <div class="w-1/3 mr-2">
                    <InputLabel for="expiry_date">Certificate Expiry Date</InputLabel>
                    <TextInput id="expiry_date" type="date" class="mt-1 block w-full"
                        v-model="certificate.expiry_date" />
                </div>
                <div class="w-1/3">
                    <input class="mt-5" type="file" @input="certificateImage($event, index)">
                </div>
            </div>



            <div class="flex flex-row">
                <PrimaryButton @click="submit" class="my-2">Add New Certificate</PrimaryButton>

                <PrimaryButton v-if="$page.props.auth.user.role != 'user'" class="my-2">
                    <Link :href="route('seafarer.detail', certificate.seafarer_id)">Cancel</Link>
                </PrimaryButton>
            </div>

        </div>
    </div>

</template>
