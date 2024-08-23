<script setup>
import { ref, watch } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';


const props = defineProps({
    Ranks: {
        type: Array,
        default: () => ['Rank 3', 'Rank 4']
    },
    Religions: {
        type: Array,
        default: () => ['Buddhism', 'Christian', 'Muslim', 'Hinduism', 'Atheist']
    },
    role_id: {
        type: String
    },
    vessel_id: {
        type: String
    },

    user_name:{
        type: String
    },
    user_email:{
        type: String
    }


});
const selectedRank = ref('');
const selectRank = (rank) => {
    selectedRank.value = rank;
    form.rank = rank
}
const selectedReligion = ref('');
const selectReligion = (religion) => {
    selectedReligion.value = religion;
    form.religion = religion
}
const showPlaceholder = ref(true);

const step_1 = ref(true);
const step_2 = ref(false);
const step_3 = ref(false);

const src = ref('');

const change = (e) => {
    const file = e.target.files[0];
    form.profile = file;

    const reader = new FileReader();
    reader.onload = (event) => {
        src.value = event.target.result;
    };

    if (file) {
        reader.readAsDataURL(file);
    }
};
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
const form = useForm({
    role_id: props.role_id,
    vessel_id: props.vessel_id,
    profile: null,
    fullname: props.user_name,
    seaman_book: '',
    seaman_book_place: '',
    issue_date: '',
    expected_salary: '',
    nationality: '',
    religion: '',
    dob: '',
    height: '',
    weight: '',
    overall_size: '',
    mobile_no: '',
    email: props.user_email,
    next_of_kin: '',
    relationship: '',
    next_of_kin_mobile: '',

});
const passport = useForm({
    passport_no: '',
    place_of_issue: '',
    issue_date: '',
    expiry_date: ''
});

const certificates = useForm({
    certificates: [
        {
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
watch(() => form.dob, (newValue) => {
    showPlaceholder.value = !newValue;
});

const changeDate = (event) => {
    event.target.type = 'date'
}
const checkEmpty = (event) => {
    if (!event.target.value) {
        event.target.type = 'text'
    }
}
const today = new Date();
const eighteenYearsAgo = new Date();
eighteenYearsAgo.setFullYear(today.getFullYear() - 18);
const maxDate = eighteenYearsAgo.toISOString().split('T')[0];


const submit = () => {
    form.post(route('seafarers.store'));
}
</script>

<template>

    <Head title="CMS" />

    <div class="sm:flex sm:justify-center sm:items-center min-h-screen bg-center bg-blue-900">
        <div class="flex flex-col items-center">
            <img src="/images/logo1.jpeg" alt="" class="w-16 h-16 text-center">
            <h1 class="text-3xl text-white mt-5">Crew Management System</h1>
            <form @submit.prevent="submit" class="p-3 bg-gray-200 rounded-md border-gray-400 shadow-md">
                <!--Personal Details-->
                <div v-if="step_1">
                    <h1 class="my-2 text-xl">Personal Details</h1>
                    <input type="file" @input="change" />
                    <img v-if="src" :src="src" alt="" class="w-24 h-24">
                    <div class="flex flex-row gap-2 my-2">
                        <div class="w-1/3">

                            <InputLabel for="name">Full Name</InputLabel>
                            <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.fullname"
                                autofocus/>

                            <InputError class="mt-2" :message="form.errors.fullname" />
                        </div>

                        <div class="w-1/3">
                            <InputLabel for="salary">Expected Salary</InputLabel>
                            <TextInput id="salary" type="number" class="mt-1 block w-full"
                                v-model="form.expected_salary" />

                            <InputError class="mt-2" :message="form.errors.expected_salary" />
                        </div>
                        <div class="mt-1 w-1/2">
                            <InputLabel for="dob">Date of Birth</InputLabel>
                            <TextInput id="dob" :max="maxDate" type="text" class="mt-1 block w-full" v-model="form.dob"
                                @focus="changeDate" @blur="checkEmpty" placeholder="Date of Birth" />

                            <InputError class="mt-2" :message="form.errors.dob" />
                        </div>
                    </div>
                    <div class="flex flex-row gap-2 my-2">
                        <div class="w-1/2">
                            <InputLabel for="nationality">Nationality</InputLabel>
                            <TextInput id="nationality" type="text" class="mt-1 block w-full"
                                v-model="form.nationality" />

                            <InputError class="mt-2" :message="form.errors.nationality" />
                        </div>
                        <div class="w-1/2">
                            <InputLabel for="">Religion</InputLabel>
                            <Dropdown align="left" width="48" contentClasses="py-2 bg-gray-100">
                                <template #trigger>
                                    <div class="mt-1 px-4 py-2 rounded-md border-2 bg-white text-gray-600 block w-full">
                                        {{ selectedReligion || 'Select Religion' }}</div>

                                </template>
                                <template #content>
                                    <ul class="px-2">
                                        <li v-for="religion in Religions" :key="religion"
                                            @click="selectReligion(religion)" class="cursor-pointer hover:bg-gray-200">
                                            {{ religion }}</li>
                                    </ul>
                                </template>
                            </Dropdown>

                        </div>
                    </div>

                    <div class="flex flex-row gap-2 my-2">
                        <div class="w-1/3">
                            <InputLabel for="height">Height</InputLabel>
                            <TextInput id="height" type="text" class="mt-1 block w-full" v-model="form.height"
                                placeholder="e.g. 5 ft 12 in" />

                            <InputError class="mt-2" :message="form.errors.height" />
                        </div>
                        <div class="w-1/3">
                            <InputLabel for="weight">Weight</InputLabel>
                            <TextInput id="weight" type="text" class="mt-1 block w-full" v-model="form.weight"
                                placeholder="in kg, e.g. 56" />
                            <InputError class="mt-2" :message="form.errors.weight" />
                        </div>
                        <div class="w-1/3">
                            <InputLabel for="overall_size">Overall_size</InputLabel>
                            <TextInput id="overall_size" type="number" min="30" max="50" class="mt-1 block w-full"
                                v-model="form.overall_size" placeholder="in EU, e.g.46" />

                            <InputError class="mt-2" :message="form.errors.overall_size" />
                        </div>

                    </div>
                    <div class="flex flex-row gap-2 my-2">
                        <div class="w-1/2">
                            <InputLabel for="mobile">Mobile Number</InputLabel>
                            <TextInput id="mobile" type="text" class="mt-1 block w-full" v-model="form.mobile_no" />

                            <InputError class="mt-2" :message="form.errors.mobile_no" />
                        </div>
                        <div class="w-1/2">
                            <InputLabel for="email">Email Address</InputLabel>
                            <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" />

                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                    </div>
                    <div class="flex flex-row gap-2 my-2">
                        <div>
                            <InputLabel for="next_of_kin">Next of Kin Name</InputLabel>
                            <TextInput id="next_of_kin" type="text" class="mt-1 block w-full"
                                v-model="form.next_of_kin" />

                            <InputError class="mt-2" :message="form.errors.next_of_kin" />
                        </div>
                        <div>
                            <InputLabel for="relationship">Relationship</InputLabel>
                            <TextInput id="relationship" type="text" class="mt-1 block w-full"
                                v-model="form.relationship" />

                            <InputError class="mt-2" :message="form.errors.relationship" />
                        </div>
                        <div>
                            <InputLabel for="next_of_kin_mobile">Next of Kin Mobile</InputLabel>
                            <TextInput id="next_of_kin_mobile" type="text" class="mt-1 block w-full"
                                v-model="form.next_of_kin_mobile" />

                            <InputError class="mt-2" :message="form.errors.next_of_kin_mobile" />
                        </div>
                    </div>
                    <div class="flex flex-row gap-2 my-2">
                        <div>
                            <InputLabel for="next_of_kin">Seaman Book Number</InputLabel>
                            <TextInput id="next_of_kin" type="text" class="mt-1 block w-full"
                                v-model="form.seaman_book" />

                            <InputError class="mt-2" :message="form.errors.seaman_book" />
                        </div>
                        <div>
                            <InputLabel for="relationship">Book Issue Date</InputLabel>
                            <TextInput id="relationship" type="date" class="mt-1 block w-full"
                                v-model="form.issue_date" />

                            <InputError class="mt-2" :message="form.errors.issue_date" />
                        </div>
                        <div>
                            <InputLabel for="next_of_kin_mobile">Book Issue Place</InputLabel>
                            <TextInput id="next_of_kin_mobile" type="text" class="mt-1 block w-full"
                                v-model="form.seaman_book_place" />

                            <InputError class="mt-2" :message="form.errors.place_of_issue" />
                        </div>
                    </div>
                    <div class="flex flex-row justify-center mt-3">
                        <PrimaryButton class=" bg-blue-500 rounded-full p-3" :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing">
                        Upload Personal Details
                        </PrimaryButton>
                    </div>


                </div>
            </form>
                <!--Personal Details-->
                <div v-if="step_2">
                    <!---Passport-->
                    <form>
                        <div>
                        <h1 class="my-2 text-xl">Passport Info</h1>
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
                                <TextInput id="issue_date" type="date" class="mt-1 block w-full"
                                    v-model="passport.issue_date" />

                                <InputError class="mt-2" :message="passport.errors.issue_date" />
                            </div>
                            <div>
                                <InputLabel for="expiry_date">Expiry Date</InputLabel>
                                <TextInput id="expiry_date" type="date" class="mt-1 block w-full"
                                    v-model="passport.expiry_date" />

                                <InputError class="mt-2" :message="passport.errors.expiry_date" />
                            </div>
                        </div>
                    </div>
                    </form>

                    <!---Passport-->


                    <div>
                        <!-- Labels displayed only once -->
                        <div class="flex gap-5">
                            <InputLabel>Certificate Name</InputLabel>
                            <InputLabel class="ms-14">Certificate Number</InputLabel>
                            <InputLabel class="ms-14">Issue Date</InputLabel>
                            <InputLabel class="ms-16">Expiry Date</InputLabel>
                            <InputLabel class="ms-20">Issuing Authority</InputLabel>

                        </div>


                        <div v-for="(certificate, index) in certificates.certificates" :key="index" class="flex flex-col gap-2 mt-2">
                            <div>
                                <TextInput type="text" v-model="certificate.name" placeholder="Certificate Name" />
                                <TextInput type="text" v-model="certificate.certificate_no"
                                    placeholder="Certificate Number" />
                                <TextInput type="date" v-model="certificate.issue_date" placeholder="Issue Date" />
                                <TextInput type="date" v-model="certificate.expiry_date" placeholder="Expiry Date" />
                                <TextInput type="text" v-model="certificate.issuing_authority"
                                    placeholder="Issuing Authority" />

                            </div>

                            <div class="flex">
                                <input type="file" @input="certificateImage($event, index)">
                                <img v-show="cert_img[index]" :src="cert_img[index]" alt="Certificate" class="w-24 h-24">
                            </div>
                            <div class="flex flex-row gap-2">
                                <button class="bg-red-300 p-2 rounded-md" type="button" @click="removeCertificate(index)">Remove</button>
                                <button class="bg-green-300 p-2 rounded-md" type="button" @click="addCertificate(index)">Add</button>
                            </div>
                        <hr style="border: 1px solid #ccc; margin: 20px 0;">
                        </div>
                        <br>
                        <button class="bg-green-200 p-3" type="button"
                            @click="step_1 = !step_1; step_2 = !step_2">1</button>
                        <button class="bg-green-200 p-3" @click="step_2 = !step_2; step_3 = !step_3"
                            type="button">3</button>
                    </div>

                </div>

                <div v-show="step_3">

                    <table class="min-w-full">
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
                                    <TextInput for="sign_on_date" type="date" v-model="experience.sign_on_date" />
                                </td>
                                <td>
                                    <TextInput for="sign_off_date" type="date" v-model="experience.sign_off_date" />
                                </td>

                                <td>
                                    <button class="me-1 text-red-500" type="button"
                                        @click="removeExperience(index)"><svg xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    </button>
                                    <button class="text-green-400" type="button" @click="addExperience(index)"><svg
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    </button>
                                </td>


                                <div>

                                </div>




                            </tr>
                        </tbody>
                    </table>

                    <div class="flex flex-row justify-end">
                        <button class="bg-green-200 p-3" @click="step_3 = !step_3; step_2 = !step_2"
                            type="button">Prev</button>
                    </div>


                </div>





        </div>



    </div>
</template>

<style>
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
