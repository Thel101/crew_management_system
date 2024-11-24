<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, usePage, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref } from 'vue';
import PersonalDetails from '../../Admin/PersonalDetail.vue';
import CertificateTable from '@/Components/CertificateTable.vue';
import ExperienceTable from '@/Components/ExperienceTable.vue';
import html2pdf from 'html2pdf.js';
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
    }
})
const changeStatus = (id) => {
    router.patch(route('certificate.status', id))
}
const page = usePage();
const clearFlashMessage = () => {
    page.props.flash.message = null
}
const filename = props.applicant.fullname + '-CV'
const printPdf = () => {
    const printElement = document.getElementById('printableSection');
    if (printElement) {
        html2pdf(printElement, {
            margin: 1,
            filename: filename,
            html2canvas: { scale: 2 },
            jsPDF: { format: 'letter', orientation: 'portrait' }
        })
    }



}
const modalTitle = ref('')
const modalMessage = ref('')
const showModal = ref(false)
const handleCertificateModal = () => {
    showModal.value = true
    modalTitle.value = 'Certificate Approval'
    modalMessage.value = 'Certificate has been approved'
}
const closeModal = () => {
    showModal.value = false
}
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>
        </template>

        <div class="py-12">
            <a :href="route('applicants.list')" class="ms-7 text-blue-600 text-lg underline">Back to Applicant List</a>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
                <div class="overflow-hidden">
                    <div class="flex flex-row bg-green-300 rounded-md  justify-between"
                        v-if="$page.props.flash.message">
                        <div class="py-3 pl-2 mb-2">{{ $page.props.flash.message }}</div>
                        <button @click="clearFlashMessage"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mt-1 mr-3">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </button>
                    </div>
                    <div id="printableSection">
                        <div class="flex flex-row">
                            <img :src="`/storage/images/${applicant.profile}`" class="w-48 h-48 rounded-md" />

                            <PersonalDetails :fullname="props.applicant.fullname"
                                :expected_salary="props.applicant.expected_salary"
                                :nationality="props.applicant.nationality" :religion="props.applicant.religion"
                                :dob="props.applicant.dob" :height="props.applicant.height"
                                :weight="props.applicant.weight" :mobile_no="props.applicant.mobile_no"
                                :email="props.applicant.email" :next_of_kin="props.applicant.next_of_kin"
                                :relationship="props.applicant.relationship"
                                :next_of_kin_phone="props.applicant.next_of_kin_mobile" :passport="props.passport"
                                :seaman_book="props.applicant.seaman_book"
                                :book_place_of_issue="props.applicant.seaman_book_place"
                                :book_issue_date="props.applicant.issue_date" :status="props.applicant.status">
                            </PersonalDetails>
                        </div>

                        <hr>
                        <div v-if="props.experiences.length > 0">
                            <CertificateTable @certificateStatusChanged="handleCertificateModal"
                                :certificates="props.certificates">
                            </CertificateTable>
                        </div>
                        <div v-else>
                            <p class="text-red-400 text-lg">No relevant certificate!</p>
                        </div>
                        <div v-if="props.experiences.length > 0">
                            <ExperienceTable :experiences="props.experiences"></ExperienceTable>
                        </div>
                        <div v-else>
                            <p class="text-red-400 text-lg">No relevant experience!</p>
                        </div>
                    </div>

                    <!-- <PrimaryButton><a target="__blank" :href="route('applicant.pdf', applicant.id)">
                        Save as PDF
                    </a></PrimaryButton> -->
                    <PrimaryButton @click="printPdf">Save as PDF</PrimaryButton>
                    <PrimaryButton> <a :href="route('send.email')">Send Email</a></PrimaryButton>

                </div>
            </div>
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


    </AuthenticatedLayout>
</template>
