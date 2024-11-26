<script setup>
import { ref, watch } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    roles: {
        type: Array
    },
    Religions: {
        type: Array,
        default: () => ['Buddhism', 'Christian', 'Muslim', 'Hinduism', 'Atheist']
    },

    vessel_id: {
        type: String
    },

    user_name: {
        type: String
    },
    user_email: {
        type: String
    }


});
const selectedRole = ref('');
const selectRole = (role) => {
    selectedRole.value = role.name;
    form.role_id = role.id
}
const selectedReligion = ref('');
const selectReligion = (religion) => {
    selectedReligion.value = religion;
    form.religion = religion
}
const showPlaceholder = ref(true);
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


const form = useForm({
    role_id: '',
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
const sixMonths = new Date();
eighteenYearsAgo.setFullYear(today.getFullYear() - 18);
sixMonths.setMonth(today.getMonth() + 6);
const maxDate = eighteenYearsAgo.toISOString().split('T')[0];


const submit = () => {
    form.post(route('seafarers.store'), {
        onSuccess: () => {
            form.reset()
        }
    });
}
</script>

<template>

    <Head title="CMS" />
    <div v-if="$page.props.auth.user.role != 'admin'"
        class="flex flex-col items-center bg-gradient-to-r from-sky-700 to-indigo-500 p-3">
        <img src="/images/logo1.jpeg" alt="" class="w-16 h-16 text-center">
        <h1 class="text-3xl text-white mt-5">Crew Management System</h1>
    </div>
    <div class="max-w-5xl mx-auto my-2">

        <form @submit.prevent="submit" class="p-3 bg-white shadow-md rounded-md border-gray-400 mt-4">
            <!--Personal Details-->
            <div>
                <h1 class="my-2 text-xl">Personal Details</h1>
                <input type="file" @input="change" />
                <img v-if="src" :src="src" alt="" class="w-24 h-24">
                <div class="flex flex-row gap-2 my-2">
                    <div class="w-1/3">

                        <InputLabel for="name">Full Name</InputLabel>
                        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.fullname" autofocus />

                        <InputError class="mt-2" :message="form.errors.fullname" />
                    </div>

                    <div class="w-1/3">
                        <InputLabel for="salary">Expected Salary</InputLabel>
                        <TextInput id="salary" type="number" class="mt-1 block w-full" v-model="form.expected_salary" />

                        <InputError class="mt-2" :message="form.errors.expected_salary" />
                    </div>
                    <div class="w-1/3">
                        <InputLabel for="">Applied Role</InputLabel>
                        <Dropdown align="left" width="48" contentClasses="py-2 bg-gray-100">
                            <template #trigger>
                                <div class="mt-1 px-4 py-2 rounded-md border-2 bg-white text-gray-600 block w-full">
                                    {{ selectedRole || 'Select Role' }}</div>

                            </template>
                            <template #content>
                                <ul class="px-2" style="max-height: 240px; overflow-y: auto;">
                                    <li v-for="role in props.roles" :key="role.id" @click="selectRole(role)"
                                        class="cursor-pointer hover:bg-gray-200">
                                        {{ role.name }}</li>
                                </ul>
                            </template>
                        </Dropdown>

                    </div>

                </div>
                <div class="flex flex-row gap-2 my-2">
                    <div class="w-1/3">
                        <InputLabel for="dob">Date of Birth</InputLabel>
                        <TextInput id="dob" :max="maxDate" type="text" class="mt-1 block w-full" v-model="form.dob"
                            @focus="changeDate" @blur="checkEmpty" placeholder="Date of Birth" />

                        <InputError class="mt-2" :message="form.errors.dob" />
                    </div>
                    <div class="w-1/3">
                        <InputLabel for="nationality">Nationality</InputLabel>
                        <TextInput id="nationality" type="text" class="mt-1 block w-full" v-model="form.nationality" />

                        <InputError class="mt-2" :message="form.errors.nationality" />
                    </div>
                    <div class="w-1/3">
                        <InputLabel for="">Religion</InputLabel>
                        <Dropdown align="left" width="48" contentClasses="py-2 bg-gray-100">
                            <template #trigger>
                                <div class="mt-1 px-4 py-2 rounded-md border-2 bg-white text-gray-600 block w-full">
                                    {{ selectedReligion || 'Select Religion' }}</div>

                            </template>
                            <template #content>
                                <ul class="px-2">
                                    <li v-for="religion in Religions" :key="religion" @click="selectReligion(religion)"
                                        class="cursor-pointer hover:bg-gray-200">
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
                    <div class="w-1/3">
                        <InputLabel for="next_of_kin">Next of Kin Name</InputLabel>
                        <TextInput id="next_of_kin" type="text" class="mt-1 block w-full" v-model="form.next_of_kin" />

                        <InputError class="mt-2" :message="form.errors.next_of_kin" />
                    </div>
                    <div class="w-1/3">
                        <InputLabel for="relationship">Relationship</InputLabel>
                        <TextInput id="relationship" type="text" class="mt-1 block w-full"
                            v-model="form.relationship" />

                        <InputError class="mt-2" :message="form.errors.relationship" />
                    </div>
                    <div class="w-1/3">
                        <InputLabel for="next_of_kin_mobile">Next of Kin Mobile</InputLabel>
                        <TextInput id="next_of_kin_mobile" type="text" class="mt-1 block w-full"
                            v-model="form.next_of_kin_mobile" />

                        <InputError class="mt-2" :message="form.errors.next_of_kin_mobile" />
                    </div>
                </div>
                <div class="flex flex-row gap-2 my-2">
                    <div class="w-1/3">
                        <InputLabel for="seaman_book">Seaman Book Number</InputLabel>
                        <TextInput id="seaman_book" type="text" class="mt-1 block w-full" v-model="form.seaman_book" />

                        <InputError class="mt-2" :message="form.errors.seaman_book" />
                    </div>
                    <div class="w-1/3">
                        <InputLabel for="book_issue_date">Book Issue Date</InputLabel>
                        <TextInput id="book_issue_date" type="date" class="mt-1 block w-full"
                            v-model="form.issue_date" />

                        <InputError class="mt-2" :message="form.errors.issue_date" />
                    </div>
                    <div class="w-1/3">
                        <InputLabel for="book_issue_place">Book Issue Place</InputLabel>
                        <TextInput id="book_issue_place" type="text" class="mt-1 block w-full"
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

    </div>


</template>

<style>
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
