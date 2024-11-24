<script setup>
import { ref, watch } from 'vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Modal from '@/Components/Modal.vue';


const props = defineProps({
    seafarer_id: {
        type: String
    },
});


const src = ref('');
const showModal = ref(false)
const cert_img = ref([]);
const certificateImage = (e, index) => {
    const cert_file = e.target.files[0];
    if (cert_file) {
        const reader = new FileReader();
        reader.onload = (event) => {
            // Update the image URL in cert_img
            cert_img.value[index] = event.target.result;
            // Also update form1 if needed
            certificates.certificates[index].cert_image = cert_file;
        };
        reader.readAsDataURL(cert_file);
    }
};

const passport = useForm({
    seafarer_id: props.seafarer_id,
    passport_no: '',
    place_of_issue: '',
    issue_date: '',
    expiry_date: ''
});

const certificates = useForm({
    certificates: [
        {
            seafarer_id: props.seafarer_id,
            name: '',
            certificate_no: '',
            issue_date: '',
            expiry_date: '',
            issuing_authority: '',
            cert_image: ''
        }
    ]
})
const addCertificate = () => {
    certificates.certificates.push({
        name: '',
        certificate_no: '',
        issue_date: '',
        expiry_date: '',
        issuing_authority: ''
    });
};

const removeCertificate = (index) => {
    certificates.certificates.splice(index, 1);
};

const experiences = useForm({
    experiences: [
        {
            seafarer_id: props.seafarer_id,
            ship_name: '',
            flag: '',
            ship_type: '',
            rank: '',
            GRT: '',
            engine_make: '',
            trade: '',
            sign_on_date: '',
            sign_off_date: ''

        }
    ]
})
const addExperience = () => {
    experiences.experiences.push({
        ship_name: '',
        flag: '',
        ship_type: '',
        rank: '',
        GRT: '',
        engine_make: '',
        trade: '',
        sign_on_date: '',
        sign_off_date: ''
    });
};

const removeExperience = (index) => {
    experiences.experiences.splice(index, 1);
};
const today = new Date().toISOString().split('T')[0];

const submit = () => {
    passport.post(route('passport.store'), {
        onSuccess: () => {
            certificates.post(route('certificates.store'), {
                onFinish: () => {
                    experiences.post(route('experiences.store'), {
                        onFinish: () => {
                            showProfile.value = true
                            passport.reset()
                            certificates.reset()
                            experiences.reset()
                            showModal.value = true
                        }
                    })
                }
            })
        }
    }
    )

}
const showProfile = ref(false)
const home = () => {
    showModal.value = false
    router.visit(route('user.home'))
}
</script>

<template>

    <Head title="CMS" />

    <div v-if="$page.props.auth.user.role != 'admin'"
        class="flex flex-col items-center bg-gradient-to-r from-sky-700 to-indigo-500 p-3">
        <img src="/images/logo1.jpeg" alt="" class="w-16 h-16 text-center">
        <h1 class="text-3xl text-white mt-5">Crew Management System</h1>
    </div>
    <div class="max-w-7xl mx-auto">

        <template>
            <div>
                <Modal :show="showModal" @close="showModal = false">
                    <template #default>
                        <div class="p-4">
                            <h2 class="text-lg font-bold">Application Successful</h2>
                            <p class="mt-2">Seafarer Application Successfully Completed!</p>
                            <button @click="home" class="mt-4 bg-blue-500 text-white py-2 px-4 rounded">
                                Close Modal
                            </button>
                        </div>
                    </template>
                </Modal>
            </div>
        </template>
        <a v-show="showProfile" class="hover:underline text-blue-600"
            :href="route('seafarer.profile', $page.props.auth.user.id)">
            Go to Profile
        </a>
        <form @submit.prevent="submit" class="mt-3 p-3 bg-white rounded-md border-gray-400 shadow-md">

            <!---Passport-->

            <div>
                <h1 class="text-xl">Passport Information</h1>
                <div class="flex flex-row gap-2 my-2">
                    <div class="w-1/4">

                        <InputLabel for="passport_no">Passport No:</InputLabel>
                        <TextInput id="passport_no" type="text" class="mt-1 block w-full"
                            v-model="passport.passport_no" />

                        <InputError class="mt-2" :message="passport.errors.passport_no" />
                    </div>
                    <div class="w-1/4">
                        <InputLabel for="place_of_issue">Place of issue</InputLabel>
                        <TextInput id="place_of_issue" type="text" class="mt-1 block w-full"
                            v-model="passport.place_of_issue" />

                        <InputError class="mt-2" :message="passport.errors.place_of_issue" />

                    </div>
                    <div class="w-1/4">
                        <InputLabel for="issue_date">Issue date</InputLabel>
                        <TextInput id="issue_date" :max="today" type="date" class="mt-1 block w-full"
                            v-model="passport.issue_date" />

                        <InputError class="mt-2" :message="passport.errors.issue_date" />
                    </div>
                    <div>
                        <InputLabel for="expiry_date">Expiry Date</InputLabel>
                        <TextInput id="expiry_date" type="date" :max="maxDate" class="mt-1 block w-full"
                            v-model="passport.expiry_date" />

                        <InputError class="mt-2" :message="passport.errors.expiry_date" />
                    </div>
                </div>

                <!---Passport-->


                <div>
                    <h1 class="mt-2 text-xl">Certificates</h1>
                    <!-- Labels displayed only once -->

                    <div v-for="(certificate, index) in certificates.certificates" :key="index"
                        class="flex flex-row gap-2 my-2 pb-5 overflow-x-auto">
                        <div>
                            <InputLabel>Certificate Name</InputLabel>
                            <TextInput type="text" v-model="certificate.name" placeholder="Certificate Name" />
                        </div>
                        <div>
                            <InputLabel>Certificate Number</InputLabel>
                            <TextInput type="text" v-model="certificate.certificate_no"
                                placeholder="Certificate Number" />
                        </div>
                        <div>
                            <InputLabel>Issue Date</InputLabel>
                            <TextInput type="date" v-model="certificate.issue_date" placeholder="Issue Date" />
                        </div>
                        <div>
                            <InputLabel>Expiry Date</InputLabel>
                            <TextInput type="date" v-model="certificate.expiry_date" placeholder="Expiry Date" />
                        </div>
                        <div>
                            <InputLabel>Issuing Authority</InputLabel>
                            <TextInput type="text" v-model="certificate.issuing_authority"
                                placeholder="Issuing Authority" />
                        </div>
                        <input class="pt-5 w-64" type="file" accept=".pdf" @input="certificateImage($event, index)">
                        <button class="text-green-400" type="button" @click="addCertificate(index)"><svg
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </button>

                        <button v-if="certificates.certificates.length > 1" class="me-1 text-red-500" type="button"
                            @click="removeCertificate(index)"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </button>
                        <hr style="border: 1px solid #ccc; margin: 20px 0;">
                    </div>


                    <br>

                </div>

            </div>

            <div class="overflow-x-auto">
                <h1 class="text-xl">Past Experiences</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Ship Name</th>
                            <th>Flag</th>
                            <th>Ship Type</th>
                            <th>Trade</th>
                            <th>GRT</th>
                            <th>Rank</th>
                            <th>Sign-on</th>
                            <th>Sign-off</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(experience, index) in experiences.experiences" :key="index">

                            <td>
                                <TextInput for="ship_name" type="text" v-model="experience.ship_name" />
                            </td>
                            <td>
                                <TextInput for="flag" type="text" v-model="experience.flag" />
                            </td>
                            <td>
                                <TextInput for="ship_type" type="text" v-model="experience.ship_type" />
                            </td>
                            <td>
                                <TextInput for="trade" type="text" v-model="experience.trade" />
                            </td>
                            <td>
                                <TextInput class="w-28" for="grt" type="text" v-model="experience.GRT" />
                            </td>
                            <td>
                                <TextInput class="w-28" for="rank" type="text" v-model="experience.rank" />
                            </td>
                            <td>
                                <TextInput for="sign_on_date" :max="today" type="date"
                                    v-model="experience.sign_on_date" />
                            </td>
                            <td>
                                <TextInput for="sign_off_date" :max="today" type="date"
                                    v-model="experience.sign_off_date" />
                            </td>

                            <td class="flex flex-row mt-1">
                                <button class="text-green-400" type="button" @click="addExperience(index)"><svg
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </button>
                                <button v-if="experiences.experiences.length > 1" class="me-1 text-red-500"
                                    type="button" @click="removeExperience(index)"><svg
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </button>

                            </td>


                            <div>

                            </div>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex flex-row justify-center mt-3">
                <PrimaryButton class=" bg-blue-500 rounded-full p-3" :class="{ 'opacity-25': passport.processing }"
                    :disabled="passport.processing">
                    Attach Documents
                </PrimaryButton>
            </div>
        </form>

    </div>
</template>

<style>
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
