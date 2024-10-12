<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link, usePage } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref } from 'vue';
import PersonalDetail from '../PersonalDetail.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Dropdown from '@/Components/Dropdown.vue';
import InputError from '@/Components/InputError.vue';
import { capitalize } from 'lodash';
import CertificateTable from '@/Components/CertificateTable.vue';
import ExperienceTable from '@/Components/ExperienceTable.vue';
import Modal from '@/Components/Modal.vue';
import Payroll from '../Payroll/Payroll.vue';
import PayrollTable from '../Payroll/PayrollTable.vue';
import MedicalDocumentsTable from '@/Components/MedicalDocumentsTable.vue';
import BankAccountTable from '@/Components/BankAccountTable.vue';
import html2pdf from 'html2pdf.js';

const page = usePage();
const props = defineProps({
    seafarer:
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
    payrolls: {
        type: Array
    },
    medical_documents: {
        type: Array
    },
    bank_accounts: {
        type: Array
    },
    leaves: {
        type: Array
    },
    basic_salary: {
        type: Number
    },
    remarks: {
        type: Array,
        default: () => [
            'compliment', 'comment', 'punishment', 'ban'
        ]
    }
})

const modalMessage = ref('');
const modalTitle = ref('');

const showForm = ref(false);
const toggleForm = () => {
    showForm.value = !showForm.value
}
const showCertificates = ref(false);
const toggleCertificates = () => {
    showCertificates.value = !showCertificates.value
}
const showExperiences = ref(false);
const toggleExperiences = () => {
    showExperiences.value = !showExperiences.value
}
const showBankSection = ref(false);
const showBankForm = ref(false);
const toggleBankForm = () => {
    showBankSection.value = !showBankSection.value
}

const showRemarkSection = ref(false);
const toggleRemarkSection = () => {
    showRemarkSection.value = !showRemarkSection.value
}
const showRemarkForm = ref(false);
const toggleRemarkForm = () => {
    showRemarkForm.value = !showRemarkForm.value
}
const showPayrollSection = ref(false);
const togglePayrollSection = () => {
    showPayrollSection.value = !showPayrollSection.value
}
const showPayrollForm = ref(false);
const togglePayrollForm = () => {
    showPayrollForm.value = !showPayrollForm.value
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

const form = useForm({
    seafarer_id: props.seafarer.id,
    type: '',
    clinic: '',
    document_date: '',
    result: '',
    file: null
})
const submitMedicalDocuments = () => {
    form.post(route('medicalDocuments.store'), {
        onSuccess: () => {
            showForm.value = false;
            showModal.value = true;
            modalTitle.value = "Successful Medical Document Submission";
            modalMessage.value = "Medical Document has been uploaded!"
            form.reset()

        }
    })
}
const bank = useForm({
    seafarer_id: props.seafarer.id,
    account_no: '',
    bank_branch: '',
    account_holder: '',
    holder_phone: ''
})
const uploadBankAccount = () => {
    bank.post(route('bankAccounts.store'), {
        onSuccess: () => {
            showBankForm.value = false
            showModal.value = true
            modalTitle.value = 'Successful Bank Account Submission'
            modalMessage.value = 'Bank Account has been successfully submitted'
            bank.reset()
        }
    })
}
const selectedRemarkType = ref('');
const chooseRemark = (chosen_remark) => {
    selectedRemarkType.value = chosen_remark;
    remarks.remark_type = chosen_remark;
}

const remarks = useForm({
    seafarer_id: props.seafarer.id,
    remark_type: '',
    comment: ''
})
if (props.seafarer.remark_type) {
    remarks.remark_type = props.seafarer.remark_type;
    remarks.comment = props.seafarer.comment
}

const submitRemark = () => {
    remarks.patch(route('seafarer.remark'), {
        onSuccess: () => {
            remarks.reset();
            showModal.value = true
            showRemarkForm.value = false
            modalMessage.value = "Remark has been submitted successfully!"
            modalTitle.value = "Successful remark submission"
        }
    });
}
const showModal = ref(false);
const closeModal = () => {
    showModal.value = false
}
const printHide = ref(true);
const printPdf = () => {
    printHide.value = false
    const printElement = document.getElementById('printableSection');
    if (printElement) {
        html2pdf(printElement, {
            margin: 1,
            filename: 'seafarer.pdf',
            html2canvas: { scale: 2 },
            jsPDF: { format: 'letter', orientation: 'landscape' }
        })
        elementsToHide.forEach(el => el.style.display = '');
    }

}
const fileBtn = ref(false)
// const showFileBtn = () =>{
//     fileBtn.value = true
// }
const showImageChange = ref(false)
const profileForm = useForm({
    seafarer_id: props.seafarer.id,
    profile: ''
});
const changeProfile = (e) => {
    profileForm.profile = e.target.files[0];
};

const uploadImage = () => {
    profileForm.post(route('seafarer.changeProfile'), {
        onSuccess: (page) => {
            showModal.value = true;
            modalTitle.value = "Profile Image Changed";
            modalMessage.value = page.props.flash.message;
            showImageChange.value = false;
        }
    })
}

</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Seafarers</h2>
        </template>

        <div id="printableSection" class="py-12 overflow-auto">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 overscroll-contain">

                <PrimaryButton @click="showImageChange = !showImageChange">Change Profile Image</PrimaryButton>
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
                <div class="overflow-hidden">
                    <div class="flex flex-row justify-end">
                        <PrimaryButton @click="printPdf">Print this page</PrimaryButton>
                        <Link :href="route('seafarer.editPage', props.seafarer.id)">
                        <PrimaryButton class="ms-2">Edit</PrimaryButton>
                        </Link>
                    </div>

                    <div class="flex flex-row">

                        <div>
                            <img :src="`/storage/images/${props.seafarer.profile}`" class="w-48 h-48 rounded-md"
                                :alt="props.seafarer.profile" />
                            <!-- <PrimaryButton class="w-full my-2 text-center" @click="showFileBtn">Change Profile Image</PrimaryButton>
                             <input type="file" v-show="fileBtn" class="w"  accept=".jpg,.jpeg,.png,.webp" name="" id=""> -->
                        </div>


                        <PersonalDetail class="w-3/4" :fullname="props.seafarer.fullname"
                            :expected_salary="props.seafarer.expected_salary" :nationality="props.seafarer.nationality"
                            :religion="props.seafarer.religion" :dob="props.seafarer.dob"
                            :height="props.seafarer.height" :weight="props.seafarer.weight"
                            :mobile_no="props.seafarer.mobile_no" :email="props.seafarer.email"
                            :next_of_kin="props.seafarer.next_of_kin" :relationship="props.seafarer.relationship"
                            :next_of_kin_phone="props.seafarer.next_of_kin_mobile"
                            :passport_no="props.passport.passport_no" :place_of_issue="props.passport.place_of_issue"
                            :issue_date="props.passport.issue_date" :expiry_date="props.passport.expiry_date"
                            :seaman_book="props.seafarer.seaman_book"
                            :book_place_of_issue="props.seafarer.place_of_issue"
                            :book_issue_date="props.seafarer.issue_date">
                        </PersonalDetail>
                    </div>
                </div>

                <hr>
                <!--Payroll-->
                <div @click="togglePayrollSection" class="flex flex-row justify-between bg-gray-200 h-14 p-3">
                    <h1>Payroll</h1>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>

                </div>
                <div class="mt-5" v-show="showPayrollSection">
                    <PayrollTable class="overflow-x-auto" v-show="props.payrolls.length > 0" :payrolls="props.payrolls">
                    </PayrollTable>
                    <PrimaryButton v-show="printHide" @click="togglePayrollForm">Calculate Payroll</PrimaryButton>
                    <Payroll :basic_salary="props.basic_salary" v-show="showPayrollForm"
                        class="bg-gray-200 rounded-md shadow-sm px-2 py-3 mt-3" :seafarer_id="props.seafarer.id">
                    </Payroll>
                </div>
                <div class="page-break"></div>
                <!--Payroll-->
                <!--Certificates-->
                <div @click="toggleCertificates" class="flex flex-row justify-between bg-gray-200 h-14 p-3 mt-3">
                    <h1>Certificates</h1>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </div>
                <div v-show="showCertificates">
                    <CertificateTable :certificates="props.certificates"></CertificateTable>
                </div>
                <!--Certificates-->
                <!--Experiences-->
                <div @click="toggleExperiences" class="flex flex-row justify-between bg-gray-200 h-14 p-3 mt-3">
                    <h1>Experiences</h1>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </div>
                <div v-show="showExperiences">
                    <ExperienceTable :experiences="props.experiences"></ExperienceTable>
                </div>
                <!--Experiences-->
                <!--Medical Documents-->
                <div @click="toggleForm" class="flex flex-row justify-between bg-gray-200 h-14 p-3 mt-3">
                    <h1>Medical Documents</h1>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>

                </div>
                <MedicalDocumentsTable v-show="props.medical_documents.length > 0" :documents="props.medical_documents">
                </MedicalDocumentsTable>
                <div v-show="showForm" class="bg-gray-200 mt-3 rounded-md shadow-sm p-3">
                    <form @submit.prevent="submitMedicalDocuments">
                        <div class="w-full">
                            <InputLabel>Clinic Name, Address</InputLabel>
                            <TextInput class="w-full" v-model="form.clinic"></TextInput>
                            <InputError class="mt-2" :message="form.errors.clinic" />
                        </div>
                        <div class="flex flex-row">
                            <div class="w-1/3 me-2">
                                <InputLabel>Document Type</InputLabel>
                                <Dropdown align="left">
                                    <template #trigger>
                                        <div
                                            class="mt-1 px-4 py-2 rounded-md border-2 bg-white text-gray-600 block w-full">
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
                            <div class="w-1/3 me-2">
                                <InputLabel>Document Date</InputLabel>
                                <input class="bg-white border-gray-100 rounded-md shadow-sm mt-1 w-full" type="date"
                                    v-model="form.document_date" />
                                <InputError class="mt-2" :message="form.errors.document_date" />
                            </div>

                            <div class="w-1/3">
                                <InputLabel>Document File</InputLabel>
                                <input type="file" @input="change" />
                                <InputError class="mt-2" :message="form.errors.file" />
                            </div>
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
                <BankAccountTable v-show="props.bank_accounts.length > 0 && showBankSection"
                    :bank_accounts="props.bank_accounts"></BankAccountTable>
                <div v-show="showBankForm" class="bg-gray-200 p-3 mt-2 rounded-md shadow-sm">

                    <form @submit.prevent="uploadBankAccount">
                        <div class="flex flex-row">
                            <div class="w-1/2 me-3">
                                <InputLabel>Bank Account Number</InputLabel>
                                <TextInput class="w-full" v-model="bank.account_no"></TextInput>
                                <InputError class="mt-2" :message="bank.errors.account_no" />
                            </div>
                            <div class="w-1/2">
                                <InputLabel>Bank Branch</InputLabel>
                                <TextInput class="w-full" v-model="bank.bank_branch"></TextInput>
                                <InputError class="mt-2" :message="bank.errors.bank_branch" />
                            </div>
                        </div>
                        <div class="flex flex-row">
                            <div class="w-1/2 me-2">
                                <InputLabel>Account Holder Name</InputLabel>
                                <TextInput class="w-full" v-model="bank.account_holder"></TextInput>
                                <InputError class="mt-2" :message="bank.errors.account_holder" />
                            </div>
                            <div class="w-1/2">
                                <InputLabel>Account Phone Number</InputLabel>
                                <TextInput class="w-full" v-model="bank.holder_phone"></TextInput>
                                <InputError class="mt-2" :message="bank.errors.holder_phone" />
                            </div>
                        </div>


                        <PrimaryButton>Add Bank Account </PrimaryButton>
                    </form>
                </div>

                <!--Remark Form-->
                <div>
                    <div @click="toggleRemarkSection" class="flex flex-row justify-between bg-gray-200 h-14 p-3 mt-3">
                        <h1>Remarks by Supervisior</h1>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>

                    </div>
                    <div v-show="showRemarkSection">

                        <div class="mt-3" v-show="seafarer.remark_type != ''">
                            <div class="flex flex-row ms-3">
                                <div class="w-1/4 font-bold text-md">{{ capitalize(seafarer.remark_type) + ' : ' }}
                                </div>
                                <div class="w-3/4 flex flex-row justify-between">
                                    <div>{{ seafarer.comment }}</div>
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
                </div>

            </div>
        </div>

    </AuthenticatedLayout>
</template>
<style scoped>
.page-break {
    page-break-before: always;
}
</style>
