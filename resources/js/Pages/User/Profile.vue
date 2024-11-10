<script setup>

import PersonalDetails from '../Admin/PersonalDetail.vue';
import TextInput from '@/Components/TextInput.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { useForm, Link, usePage } from '@inertiajs/vue3'
import CertificateTable from '@/Components/CertificateTable.vue';
import ExperienceTable from '@/Components/ExperienceTable.vue';
import LeaveList from '@/Components/LeaveList.vue';
import PayrollTable from '../Admin/Payroll/PayrollTable.vue';
import { watch, ref } from 'vue';
import Modal from '@/Components/Modal.vue';
import AddNewCertificate from './AddNewCertificate.vue';
import AddNewExperience from './AddNewExperience.vue';
import EditProfile from './EditProfile.vue';
const page = usePage();
const props = defineProps({
    message: {
        type: Object
    },

    applicant: {
        type: Object
    },
    passport: {
        type: Object
    },
    vessel: {
        type: Object
    },
    certificates: {
        type: Object
    },
    experiences: {
        type: Object
    },
    payrolls: {
        type: Array
    },
    leaves: {
        type: Array
    }
})
const today = new Date().toISOString().split('T')[0];

console.log(props.applicant)
const form = useForm({
    seafarer_id: props.applicant && props.applicant.id ? props.applicant.id : '',
    leave_start: '',
    leave_end: '',
    reason: ''
})
const endDate = ref('');
watch(() => form.leave_start, (value) => {
    const date = new Date(value);
    const leaveEndDate = new Date();
    leaveEndDate.setDate(date.getDate() + 1)
    endDate.value = leaveEndDate.toISOString().split('T')[0]
})

const submitLeave = () => {
    form.post(route('leave.store'), {
        onFinish: () => {
            form.reset();
            showLeaveForm.value = false;
            handleModal('Leave Requested', 'Your leave request has been submitted successfully');

        }
    })
}


const showLeaveForm = ref(false);
const toggleLeaveForm = () => {
    showLeaveForm.value = !showLeaveForm.value
}
const showEditForm = ref(false);
const editForm = useForm(
    props.applicant
        ? {
            seafarer_id: props.applicant.id || '',
            fullname: props.applicant.fullname,
            dob: props.applicant.dob,
            nationality: props.applicant.nationality,
            religion: props.applicant.religion,
            height: props.applicant.height,
            weight: props.applicant.weight,
            overall_size: props.applicant.overall_size,
            mobile_no: props.applicant.mobile_no,
            email: props.applicant.email,
            next_of_kin: props.applicant.next_of_kin,
            relationship: props.applicant.relationship,
            next_of_kin_mobile: props.applicant.next_of_kin_mobile,
        }
        : {
            seafarer_id: '',
            fullname: '',
            dob: '',
            nationality: '',
            religion: '',
            height: '',
            weight: '',
            overall_size: '',
            mobile_no: '',
            email: '',
            next_of_kin: '',
            relationship: '',
            next_of_kin_mobile: '',
        }
)
const showModal = ref(false);
const modalTitle = ref('');
const modalMessage = ref('');
const closeModal = () => {
    showModal.value = false
}
const profileUpdate = () => {

    editForm.post(route('seafarer.profileUpdate'), {
        onFinish: () => {
            showEditForm.value = false
            handleModal('Profile Updated', 'Your profile has been updated successfully');
        }
    })
}
const showCertificateForm = ref(false);
const addCertificateSuccess = () => {
    showCertificateForm.value = false
    handleModal('Certificate Added', 'Certificate has been added successfully');
}
const showExperienceForm = ref(false);
const addExperienceSuccess = () => {
    showExperienceForm.value = false
    handleModal('Experience Added', 'Experience has been added successfully');
}
const profileForm = useForm(
    props.applicant
        ? {
            seafarer_id: props.applicant.id || '',
            profile: ''
        }
        : {
            seafarer_id: '',
            profile: ''
        }

);
const showImageChange = ref(false);
const changeProfile = (e) => {
    profileForm.profile = e.target.files[0];
};

const uploadImage = () => {
    profileForm.post(route('seafarer.changeProfile'), {
        onSuccess: () => {
            handleModal('Profile Image Updated', 'Your profile image has been updated successfully');
            showImageChange.value = false;
        }
    })
}
const handleModal = (title, message) => {
    showModal.value = true;
    modalTitle.value = title;
    modalMessage.value = message;
}
</script>
<template>
    <div class="flex flex-col items-center bg-gradient-to-r from-sky-700 to-indigo-500 p-3">
        <img src="/images/logo1.jpeg" alt="" class="w-16 h-16 text-center">
        <h1 class="text-3xl text-white mt-5">Crew Management System</h1>
    </div>

    <div v-if="props.applicant && props.passport" class="my-2">
        <div class="text-center">
            <Link class="hover:underline text-blue-600" :href="route('user.welcome')">Back to Home
            Page</Link>
        </div>


        <EditProfile v-if="props.applicant && props.passport && showEditForm"
            class="max-w-7xl mx-auto border-slate-300 border-2 rounded-md p-2">

        </EditProfile>
        <div v-else class="max-w-7xl mx-auto border-slate-300 border-2 rounded-md p-2">
            <div class="flex flex-row justify-between">

                <img :src="`/storage/images/${applicant.profile}`"
                    class="w-48 h-48 rounded-md border-slate-300 border-2" />
                <div>
                    <button class="bg-blue-400 px-5 py-3 rounded-md self-start mx-2"
                        @click="showImageChange = !showImageChange">Update
                        Image</button>
                    <button class="bg-blue-400 px-5 py-3 rounded-md self-start"
                        @click="showEditForm = !showEditForm">Edit</button>
                </div>

            </div>
            <div class="flex flex-row" v-show="showImageChange">
                <button @click="uploadImage" class="my-2 mr-2 rounded-md bg-black text-white px-2"><svg
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                    </svg>
                </button>
                <input class="my-2" accept=".jpg,.jpeg,.png,.webp" @change="changeProfile" type="file">

            </div>

            <PersonalDetails :fullname="props.applicant.fullname" :expected_salary="props.applicant.expected_salary"
                :nationality="props.applicant.nationality" :religion="props.applicant.religion"
                :dob="props.applicant.dob" :height="props.applicant.height" :weight="props.applicant.weight"
                :mobile_no="props.applicant.mobile_no" :email="props.applicant.email"
                :next_of_kin="props.applicant.next_of_kin" :relationship="props.applicant.relationship"
                :next_of_kin_phone="props.applicant.next_of_kin_mobile" :passport_no="props.passport.passport_no"
                :place_of_issue="props.passport.place_of_issue" :issue_date="props.passport.issue_date"
                :expiry_date="props.passport.expiry_date" :seaman_book="props.applicant.seaman_book"
                :book_place_of_issue="props.applicant.place_of_issue" :book_issue_date="props.applicant.issue_date"
                :status="props.applicant.status">
            </PersonalDetails>

        </div>
        <div class="max-w-7xl mx-auto border-slate-300 border-2 rounded-md p-2">
            <div class="my-10 ml-6" v-if="props.applicant.status == 'on_boarding' && vessel">
                <span class="bg-blue-400 p-5 rounded-md font-bold">Assigned Vessel: {{ props.vessel.name }}</span>
                <span class="ml-4 bg-yellow-300 p-5 rounded-md font-bold">Salary: 40000$</span>
            </div>
            <div>
                <div class="flex justify-between">
                    <h1 class="text-lg font-bold">Certificates</h1>
                    <PrimaryButton class="mr-12" @click="showCertificateForm = !showCertificateForm">Add New

                    </PrimaryButton>
                </div>
                <CertificateTable :certificates="props.certificates"></CertificateTable>
                <AddNewCertificate @certificateAdded="addCertificateSuccess" :seafarer_id="props.applicant.id"
                    v-if="showCertificateForm">
                </AddNewCertificate>
            </div>
            <div>
                <div class="flex justify-between">
                    <h1 class="text-lg font-bold">Experiences</h1>
                    <PrimaryButton class="mr-12" @click="showExperienceForm = !showExperienceForm">Add New

                    </PrimaryButton>
                </div>
                <ExperienceTable :experiences="props.experiences"></ExperienceTable>
                <AddNewExperience @experienceAdded="addExperienceSuccess" :seafarer_id="props.applicant.id"
                    v-if="showExperienceForm">
                </AddNewExperience>
            </div>
            <div v-if="props.applicant.status != 'new'">
                <h1 class="text-lg font-bold">Payrolls</h1>
                <PayrollTable v-show="props.payrolls.length > 0" :payrolls="props.payrolls"></PayrollTable>
                <div class="text-red-400 mx-2 font-semibold" v-show="props.payrolls.length == 0">No payroll calculated
                    yet!
                </div>
            </div>
            <div v-if="props.applicant.status != 'new'">
                <LeaveList v-show="props.leaves.length > 0" :leaves="props.leaves"></LeaveList>
                <div class="text-red-400 mx-2 font-semibold" v-show="props.leaves.length == 0">No leaves taken yet!
                </div>
            </div>
            <PrimaryButton v-if="props.applicant.status != 'new'" @click="toggleLeaveForm">Request Leave</PrimaryButton>
            <div v-show="showLeaveForm" class="mt-2">
                <form @submit.prevent="submitLeave">
                    <div class="flex flex-row">
                        <div class="w-1/3 mx-2">
                            <InputLabel>Leave Start Date</InputLabel>
                            <TextInput type="date" class="w-full" :min="today" v-model="form.leave_start"></TextInput>
                        </div>
                        <div class="w-1/3 mx-2">
                            <InputLabel>Leave End Date</InputLabel>
                            <TextInput type="date" class="w-full" :min="endDate" v-model="form.leave_end"></TextInput>
                        </div>
                        <div class="w-1/3 mx-2">
                            <InputLabel>Leave Reason</InputLabel>
                            <TextInput class="w-full" v-model="form.reason"></TextInput>
                        </div>
                    </div>

                    <PrimaryButton>Submit Leave Request</PrimaryButton>
                </form>
            </div>
        </div>
    </div>
    <div v-else>
        <h1 class="text-center text-green-500 text-xl mt-5">{{ props.message }}</h1>
        <div class="flex justify-center">
            <a :href="route('cvforms.index')">
                <PrimaryButton class="w-64 justify-center">
                    Apply Now
                </PrimaryButton>
            </a>
            <Link method="post" :href="route('logout')"
                class="bg-yellow-300 px-2 py-1 rounded-lg hidden md:inline ms-2 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-900 dark:hover:text-gray-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
            Log out</Link>
        </div>
    </div>
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
