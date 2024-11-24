<script setup>
import { ref, watch } from 'vue';
import { router, useForm, usePage } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Modal from '@/Components/Modal.vue';

const props = defineProps({
    Religions: {
        type: Array,
        default: () => ['Buddhism', 'Christian', 'Muslim', 'Hinduism', 'Atheist']
    },
    roles: {
        type: Array
    },
    seafarer: {
        type: Object
    },
    passport: {
        type: Object
    },
    routeName: {
        type: String
    }

});


const form = useForm({
    role_id: props.seafarer.role_id,
    profile: '' || props.seafarer.profile,
    fullname: props.seafarer.fullname,
    seaman_book: props.seafarer.seaman_book,
    seaman_book_place: props.seafarer.seaman_book_place,
    issue_date: props.seafarer.issue_date,
    nationality: props.seafarer.nationality,
    religion: props.seafarer.religion,
    dob: props.seafarer.dob,
    height: props.seafarer.height,
    weight: props.seafarer.weight,
    overall_size: props.seafarer.overall_size,
    mobile_no: props.seafarer.mobile_no,
    email: props.seafarer.email,
    next_of_kin: props.seafarer.next_of_kin,
    relationship: props.seafarer.relationship,
    next_of_kin_mobile: props.seafarer.next_of_kin_mobile,
});

const selectedReligion = ref('');
const selectReligion = (religion) => {
    selectedReligion.value = religion;
    form.religion = religion
}

const selectedRole = ref(props.seafarer.role ? props.seafarer.role.name : '');
const selectRole = (role) => {
    selectedRole.value = role.name;
    form.role_id = role.id
}
const showPlaceholder = ref(true);

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

const showModal = ref(false);
const closeModal = () => {
    showModal.value = false
}
const modalMessage = ref('');
const modalTitle = ref('');


const update = () => {
    form.patch(route('seafarers.update', props.seafarer), {
        onSuccess: (page) => {
            showModal.value = true;
            modalTitle.value = 'Profile Edit Successful';
            modalMessage.value = page.props.flash.message;
        },

    });
};
</script>

<template>

    <div class="max-w-5xl mx-auto">

        <form @submit.prevent="update" enctype="multipart/form-data"
            class="p-3 bg-white shadow-md rounded-md border-gray-400 mt-4">
            <!--Personal Details-->
            <div>
                <input type="hidden" name="redirect_route" value="{{  }}">

                <img :src="`/storage/images/${props.seafarer.profile}`" alt="" class="w-24 h-24">
                <div class="flex flex-row gap-2 my-2">
                    <div class="w-1/3">

                        <InputLabel for="name">Full Name</InputLabel>
                        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.fullname" autofocus />

                        <InputError class="mt-2" :message="form.errors.fullname" />
                    </div>

                    <div class="w-1/3">
                        <InputLabel for="">Applied Role</InputLabel>
                        <Dropdown align="left" width="48" contentClasses="py-2 bg-gray-100">
                            <template #trigger>
                                <div class="mt-1 px-4 py-2 rounded-md border-2 bg-white text-gray-600 block w-full">
                                    {{ selectedRole || 'Select Role' }}</div>

                            </template>
                            <template #content>
                                <ul class="px-2">
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
                        <InputLabel for="next_of_kin">Seaman Book Number</InputLabel>
                        <TextInput id="next_of_kin" type="text" class="mt-1 block w-full" v-model="form.seaman_book" />

                        <InputError class="mt-2" :message="form.errors.seaman_book" />
                    </div>
                    <div class="w-1/3">
                        <InputLabel for="relationship">Book Issue Date</InputLabel>
                        <TextInput id="relationship" type="date" class="mt-1 block w-full" v-model="form.issue_date" />

                        <InputError class="mt-2" :message="form.errors.issue_date" />
                    </div>
                    <div class="w-1/3">
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

<style>
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
