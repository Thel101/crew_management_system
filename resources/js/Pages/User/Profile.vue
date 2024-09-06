<script setup>

import PersonalDetails from '../Admin/PersonalDetail.vue';
import TextInput from '@/Components/TextInput.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { useForm, Link } from '@inertiajs/vue3'

const props = defineProps({
    message:{
        type: Object
    },

    applicant: {
        type: Object
    },
    passport: {
        type: Object
    },
    vessel:{
        type: Object
    }
})
const today = new Date();
const form = useForm({
    seafarer_id : props.applicant.id,
    leave_start: '',
    leave_end: '',
    reason: ''
})
const submitLeave = ()=>{
    form.post(route('leave.store'),{
        onFinish:()=>{
            form.reset();
        }
    })
}
console.log(today);
</script>
<template>
    <div class="flex flex-col items-center bg-gradient-to-r from-sky-700 to-indigo-500 p-3">
        <img src="/images/logo1.jpeg" alt="" class="w-16 h-16 text-center">
        <h1 class="text-3xl text-white mt-5">Crew Management System</h1>
    </div>
    <div v-if="props.message">
        <h1 class="text-center text-xl mt-5">{{ props.message }}</h1>
        <a :href="route('cvforms.index')"><PrimaryButton>Apply Now</PrimaryButton></a>
    </div>
    <div class="text-center my-2">
            <Link class="text-center hover:underline text-blue-600" :href="route('user.welcome')">Back to Home Page</Link>
        </div>
    <div v-if="props.applicant && props.passport">
        <img :src="`/storage/images/${applicant.profile}`" class="w-48 h-48 rounded-md" />
        <PersonalDetails :fullname="props.applicant.fullname" :expected_salary="props.applicant.expected_salary"
        :nationality="props.applicant.nationality" :religion="props.applicant.religion" :dob="props.applicant.dob"
        :height="props.applicant.height" :weight="props.applicant.weight" :mobile_no="props.applicant.mobile_no"
        :email="props.applicant.email" :next_of_kin="props.applicant.next_of_kin"
        :relationship="props.applicant.relationship" :next_of_kin_phone="props.applicant.next_of_kin_mobile"
        :passport_no="props.passport.passport_no" :place_of_issue="props.passport.place_of_issue"
        :issue_date="props.passport.issue_date" :expiry_date="props.passport.expiry_date"
        :seaman_book="props.applicant.seaman_book" :book_place_of_issue="props.applicant.place_of_issue"
        :book_issue_date="props.applicant.issue_date"></PersonalDetails>

    <div v-if="props.applicant.status == 'on_boarding'">
        <span>Assigned Vessel: {{ props.vessel.name }}</span>
        <span>Salary: 40000$</span>
    </div>
    <div>
        <form @submit.prevent="submitLeave">
        <div>
            <InputLabel>Leave Start Date</InputLabel>
            <TextInput type="date" :max="today" v-model="form.leave_start"></TextInput>
        </div>
        <div>
            <InputLabel>Leave End Date</InputLabel>
            <TextInput type="date" v-model="form.leave_end"></TextInput>
        </div>
        <div>
            <InputLabel>Leave Reason</InputLabel>
            <TextInput  v-model="form.reason"></TextInput>
        </div>
        <PrimaryButton>Submit Leave Request</PrimaryButton>
        </form>
    </div>
    </div>

</template>
