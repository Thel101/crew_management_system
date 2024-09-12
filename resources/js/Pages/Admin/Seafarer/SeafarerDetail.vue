<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref } from 'vue';
import PersonalDetails from '../PersonalDetail.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Dropdown from '@/Components/Dropdown.vue';
import InputError from '@/Components/InputError.vue';
import { capitalize } from 'lodash';
import CertificateTable from '@/Components/CertificateTable.vue';
import ExperienceTable from '@/Components/ExperienceTable.vue';
import Modal from '@/Components/Modal.vue';
const open = ref(false)

const props = defineProps({
    applicant:
    {
        type: Object
    },
    jobs: {
        type: Object
    },

    passport: {
        type: Object
    },
    certificates: {
        type: Array
    },
    experiences: {
        type: Array
    },
    remarks: {
        type: Array,
        default: () => [
            'compliment', 'comment', 'punishment', 'ban'
        ]
    }
})
console
const showForm = ref(false);
const toggleForm = () => {
    showForm.value = !showForm.value
}
const showBankForm = ref(false);
const toggleBankForm = () => {
    showBankForm.value = !showBankForm.value
}

const showRemarkSection = ref(false);
const toggleRemarkSection = () => {
    showRemarkSection.value = !showRemarkSection.value
}
const showRemarkForm = ref(false);
const toggleRemarkForm = () => {
    console.log('clicked');
    showRemarkForm.value = !showRemarkForm.value
}
const change = (e) => {
    const result_file = e.target.files[0];
    form.file = result_file
}

const selectedType = ref('');
const selectType = (chosen_type) => {
    selectedType.value = chosen_type;
    form.type = chosen_type;
}
const selectedResult = ref('');
const selectResult = (chosen_result) => {
    selectedResult.value = chosen_result;
    form.result = chosen_result;
}

const form = useForm({
    seafarer_id: props.applicant.id,
    type: '',
    clinic: '',
    document_date: '',
    result: '',
    file: null
})
const submitMedicalDocuments = () => {
    form.post(route('medicalDocuments.store'), {
        onFinish: () => {
            showForm.value = false();
            form.seafared_id = '';
            form.type = '';
            form.clinic = '';
            form.document_date = '';
            form.result = '';
            form.file = null;
        }
    })
}
const bank = useForm({
    seafarer_id: props.applicant.id,
    account_no: '',
    bank_branch: '',
    account_holder: '',
    holder_phone: ''
})
const uploadBankAccount = () => {
    bank.post(route('bankAccounts.store'), {

    })
}
const selectedRemarkType = ref('');
const chooseRemark = (chosen_remark) => {
    selectedRemarkType.value = chosen_remark;
    remarks.remark_type = chosen_remark;
}

const remarks = useForm({
    seafarer_id: props.applicant.id,
    remark_type: '',
    comment: ''
})
if (props.applicant.remark_type) {
    remarks.remark_type = props.applicant.remark_type;
    remarks.comment = props.applicant.comment
}

const submitRemark = () => {
    remarks.patch(route('seafarer.remark'), {
        onSuccess: () => {
            remarks.reset();
            showModal.value = true
            showRemarkForm.value = false
        }
    });
}
const showModal = ref(false);
const closeModal = ()=>{
    showModal.value = false
}
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Seafarers</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-if="$page.props.flash.message">
                    {{ $page.props.flash.message }}
                </div>
                <div class="overflow-hidden">
                    <div class="flex flex-row">
                        <!-- storag//app/public/images/66dacae161fb0vietnam.jpg -->
                        <img :src="`/storage/images/${props.applicant.profile}`" class="w-48 h-48 rounded-md"
                            :alt="props.applicant.profile" />

                        <PersonalDetails class="w-3/4" :fullname="props.applicant.fullname"
                            :expected_salary="props.applicant.expected_salary"
                            :nationality="props.applicant.nationality" :religion="props.applicant.religion"
                            :dob="props.applicant.dob" :height="props.applicant.height" :weight="props.applicant.weight"
                            :mobile_no="props.applicant.mobile_no" :email="props.applicant.email"
                            :next_of_kin="props.applicant.next_of_kin" :relationship="props.applicant.relationship"
                            :next_of_kin_phone="props.applicant.next_of_kin_mobile"
                            :passport_no="props.passport.passport_no" :place_of_issue="props.passport.place_of_issue"
                            :issue_date="props.passport.issue_date" :expiry_date="props.passport.expiry_date"
                            :seaman_book="props.applicant.seaman_book"
                            :book_place_of_issue="props.applicant.place_of_issue"
                            :book_issue_date="props.applicant.issue_date"></PersonalDetails>
                    </div>
                </div>

                <hr>
                <!--Certificates-->
                <div>
                    <CertificateTable :certificates="props.certificates"></CertificateTable>
                </div>
                <!--Certificates-->
                <!--Experiences-->
                <div>
                    <ExperienceTable :experiences="props.experiences"></ExperienceTable>
                </div>
                <!--Experiences-->
                <!--Medical Documents-->
                <div @click="toggleForm" class="flex flex-row justify-between bg-gray-200 h-14 p-3">
                    <h1>Medical Documents</h1>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>

                </div>
                <div v-show="showForm">
                    <form @submit.prevent="submitMedicalDocuments">
                        <div>
                            <InputLabel>Clinic Name, Address</InputLabel>
                            <TextInput v-model="form.clinic"></TextInput>
                            <InputError class="mt-2" :message="form.errors.clinic" />
                        </div>
                        <div>
                            <InputLabel>Document Type</InputLabel>
                            <Dropdown align="left">
                                <template #trigger>
                                    <div class="mt-1 px-4 py-2 rounded-md border-2 bg-white text-gray-600 block w-full">
                                        {{ selectedType || 'Select document type' }}</div>
                                </template>
                                <template #content>
                                    <ul>
                                        <li @click="selectType('general')">Medical Check Up</li>
                                        <li @click="selectType('d_c')">Drug & Alcohol Result</li>
                                        <li @click="selectType('vaccination')">Vaccination Record</li>
                                    </ul>
                                </template>
                            </Dropdown>
                            <InputError class="mt-2" :message="form.errors.type" />
                        </div>
                        <div>
                            <InputLabel>Document Date</InputLabel>
                            <input type="date" v-model="form.document_date" />
                            <InputError class="mt-2" :message="form.errors.document_date" />
                        </div>
                        <div>
                            <InputLabel>Result</InputLabel>
                            <Dropdown align="left">
                                <template #trigger>
                                    <div class="mt-1 px-4 py-2 rounded-md border-2 bg-white text-gray-600 block w-full">
                                        {{ selectedResult || 'Select Result' }}</div>
                                </template>
                                <template #content>
                                    <ul>
                                        <li @click="selectResult('pass')">Pass</li>
                                        <li @click="selectResult('fail')">Fail</li>
                                        <li @click="selectResult('pending')">Pending</li>
                                    </ul>
                                </template>
                            </Dropdown>
                            <InputError class="mt-2" :message="form.errors.result" />
                        </div>
                        <div>
                            <InputLabel>Document File</InputLabel>
                            <input type="file" @input="change" />
                            <InputError class="mt-2" :message="form.errors.file" />
                        </div>
                        <PrimaryButton>Upload Documents</PrimaryButton>
                    </form>
                </div>
                <!--Bank Account-->
                <div @click="toggleBankForm" class="flex flex-row justify-between bg-gray-200 h-14 p-3 mt-3">
                    <h1>Bank Accounts</h1>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>

                </div>
                <div v-show="showBankForm">
                    <form @submit.prevent="uploadBankAccount">
                        <div>
                            <InputLabel>Bank Account Number</InputLabel>
                            <TextInput v-model="bank.account_no"></TextInput>
                            <InputError class="mt-2" :message="bank.errors.account_no" />
                        </div>
                        <div>
                            <InputLabel>Bank Branch</InputLabel>
                            <TextInput v-model="bank.bank_branch"></TextInput>
                            <InputError class="mt-2" :message="bank.errors.bank_branch" />
                        </div>
                        <div>
                            <InputLabel>Account Holder Name</InputLabel>
                            <TextInput v-model="bank.account_holder"></TextInput>
                            <InputError class="mt-2" :message="bank.errors.account_holder" />
                        </div>
                        <div>
                            <InputLabel>Account Phone Number</InputLabel>
                            <TextInput v-model="bank.holder_phone"></TextInput>
                            <InputError class="mt-2" :message="bank.errors.holder_phone" />
                        </div>

                        <PrimaryButton>Add Bank Account </PrimaryButton>
                    </form>
                </div>

                <!--Remark Form-->
                <div @click="toggleRemarkSection" class="flex flex-row justify-between bg-gray-200 h-14 p-3 mt-3">
                    <h1>Remarks by Supervisior</h1>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>

                </div>
                <div v-show="showRemarkSection">

                    <div class="mt-3" v-show="applicant.remark_type != ''">
                        <div class="flex flex-row ms-3">
                            <div class="w-1/4 font-bold text-md">{{ capitalize(applicant.remark_type) + ' : ' }} </div>
                            <div class="w-3/4 flex flex-row justify-between">
                                <div>{{ applicant.comment }}</div>
                                <div>
                                    <svg @click="toggleRemarkForm" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="size-6 text-blue-400">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>

                                </div>
                            </div>
                        </div>

                    </div>

                    <form v-show="showRemarkForm" @submit.prevent="submitRemark"
                        class="mt-3 bg-gray-200 p-2 rounded-md shadow-sm">
                        <div class="flex flex-row w-full">
                            <div class="mr-2 w-1/4">
                                <InputLabel>Remark Type</InputLabel>
                                <Dropdown align="left">
                                    <template #trigger>
                                        <div
                                            class="mt-1 px-4 py-2 rounded-md border-2 bg-white text-gray-600 block w-full">
                                            {{ selectedRemarkType || 'Select remark type' }}</div>
                                    </template>
                                    <template #content>
                                        <ul class="px-2">
                                            <li v-for="remark in props.remarks" :key="remark"
                                                @click="chooseRemark(remark)">{{ remark }}
                                            </li>

                                        </ul>


                                    </template>
                                </Dropdown>
                                <InputError class="mt-2" :message="remarks.errors.remark_type" />
                            </div>
                            <div class="w-3/4">
                                <InputLabel>Comments</InputLabel>
                                <textarea
                                    class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    v-model="remarks.comment"></textarea>
                                <InputError class="mt-2" :message="remarks.errors.comment" />
                            </div>
                        </div>


                        <PrimaryButton>Submit Remark </PrimaryButton>
                    </form>
                </div>
                <template>
                    <Modal :show="showModal" :closeable="true" class="max-w-md" :maxWidth="md" @close="closeModal">
                        <div class="p-4 bg-green-200">
                            <h2 class="text-lg font-bold">Remark Submission Successful</h2>
                            <p>Remark has been successfully submitted!</p>
                            <div class="flex flex-row justify-end">
                                <button @click="closeModal" class="bg-gray-300 rounded-md border-2 border-slate-300 px-3 py-2 mt-4">Close</button>
                            </div>
                        </div>
                    </Modal>
                </template>

            </div>
        </div>


    </AuthenticatedLayout>
</template>
