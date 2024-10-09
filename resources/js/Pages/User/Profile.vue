<script setup>

import PersonalDetails from '../Admin/PersonalDetail.vue';
import TextInput from '@/Components/TextInput.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { useForm, Link } from '@inertiajs/vue3'
import CertificateTable from '@/Components/CertificateTable.vue';
import ExperienceTable from '@/Components/ExperienceTable.vue';
import LeaveList from '@/Components/LeaveList.vue';
import PayrollTable from '../Admin/Payroll/PayrollTable.vue';
import { watch, ref } from 'vue';
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

// if (props.applicant) {
const form = useForm({
    seafarer_id: props.applicant.id,
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
            form.leave_start = '',
                form.leave_end = '',
                form.reason = ''

        }
    })
}
// }

const showLeaveForm = ref(false);
const toggleLeaveForm = () => {
    showLeaveForm.value = !showLeaveForm.value
}
</script>
<template>
    <div class="flex flex-col items-center bg-gradient-to-r from-sky-700 to-indigo-500 p-3">
        <img src="/images/logo1.jpeg" alt="" class="w-16 h-16 text-center">
        <h1 class="text-3xl text-white mt-5">Crew Management System</h1>
    </div>
    <div v-if="props.message">
        <h1 class="text-center text-green-500 text-xl mt-5">{{ props.message }} !!</h1>
        <div class="flex justify-center">
            <a :href="route('cvforms.index')">
                <PrimaryButton class="w-64 justify-center">
                    Apply Now
                </PrimaryButton>
            </a>
        </div>
    </div>
    <div class="text-center my-2">
        <Link class="text-center hover:underline text-blue-600" :href="route('user.welcome')">Back to Home Page</Link>
    </div>
    <div class="max-w-7xl mx-auto border-slate-300 border-2 rounded-md p-2" v-if="props.applicant && props.passport">
        <img :src="`/storage/images/${applicant.profile}`" class="w-48 h-48 rounded-md border-slate-300 border-2" />
        <PersonalDetails :fullname="props.applicant.fullname" :expected_salary="props.applicant.expected_salary"
            :nationality="props.applicant.nationality" :religion="props.applicant.religion" :dob="props.applicant.dob"
            :height="props.applicant.height" :weight="props.applicant.weight" :mobile_no="props.applicant.mobile_no"
            :email="props.applicant.email" :next_of_kin="props.applicant.next_of_kin"
            :relationship="props.applicant.relationship" :next_of_kin_phone="props.applicant.next_of_kin_mobile"
            :passport_no="props.passport.passport_no" :place_of_issue="props.passport.place_of_issue"
            :issue_date="props.passport.issue_date" :expiry_date="props.passport.expiry_date"
            :seaman_book="props.applicant.seaman_book" :book_place_of_issue="props.applicant.place_of_issue"
            :book_issue_date="props.applicant.issue_date"></PersonalDetails>

        <div v-if="props.applicant.status == 'on_boarding' && vessel">
            <span>Assigned Vessel: {{ props.vessel.name }}</span>
            <span>Salary: 40000$</span>
        </div>
        <div>
            <CertificateTable :certificates="props.certificates"></CertificateTable>
        </div>
        <div>
            <ExperienceTable :experiences="props.experiences"></ExperienceTable>
        </div>
        <div>
            <PayrollTable v-show="props.payrolls.length > 0" :payrolls="props.payrolls"></PayrollTable>
            <div class="text-red-400 mx-2 font-semibold" v-show="props.payrolls.length == 0">No payroll calculated yet!</div>
        </div>
        <div>
            <LeaveList v-show="props.leaves.length > 0" :leaves="props.leaves"></LeaveList>
            <div class="text-red-400 mx-2 font-semibold" v-show="props.leaves.length == 0">No leaves taken yet!</div>
        </div>
        <PrimaryButton @click="toggleLeaveForm">Request Leave</PrimaryButton>
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

</template>
