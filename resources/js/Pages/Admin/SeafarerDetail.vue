<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref } from 'vue';
import PersonalDetails from '../Admin/PersonalDetail.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Dropdown from '@/Components/Dropdown.vue';
import InputError from '@/Components/InputError.vue';


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
const showForm = ref(false);
const toggleForm = () => {
    showForm.value = !showForm.value
}
const change = (e)=>{
    const result_file = e.target.files[0];
    form.file = result_file
}
const selectedType = ref('');
const selectType = (chosen_type)=>{
    selectedType.value = chosen_type;
    form.type = chosen_type;
}
const selectedResult = ref('');
const selectResult=(chosen_result)=>{
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
    form.post(route('seafarer.medical'),{
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
                        <img :src="`/storage/images/${applicant.profile}`" class="w-48 h-48 rounded-md" />
                        <PersonalDetails :fullname="props.applicant.fullname"
                            :expected_salary="props.applicant.expected_salary"
                            :nationality="props.applicant.nationality" :religion="props.applicant.religion"
                            :dob="props.applicant.dob" :height="props.applicant.height" :weight="props.applicant.weight"
                            :mobile_no="props.applicant.mobile_no" :email="props.applicant.email"
                            :next_of_kin="props.applicant.next_of_kin" :relationship="props.applicant.relationship"
                            :next_of_kin_phone="props.applicant.next_of_kin_mobile"></PersonalDetails>
                    </div>
                </div>
                <!---Passport---->
                <hr class="h-8">
                <div class="flex flex-row justify-between">
                    <div>
                        <h1>Passport</h1>
                        <div>Passport No: {{ passport.passport_no }}</div>
                        <div>Place of issue: {{ passport.place_of_issue }}</div>
                        <div>Issue Date {{ passport.issue_date }}</div>
                        <div>Expiry Date: {{ passport.expiry_date }}</div>
                    </div>
                    <div>
                        <h1>Seaman Book</h1>
                        <div>Seaman book No: {{ applicant.applicant }}</div>
                        <div>Place of issue: {{ applicant.place_of_issue }}</div>
                        <div>Issue Date {{ applicant.issue_date }}</div>

                    </div>

                </div>
                <!---Passport---->
                <hr>
                <!--Certificates-->
                <div>
                    <h1>Certificates</h1>
                    <table class="mx-auto divide-y-2 divide-gray-200 bg-white text-sm">
                        <thead class="ltr:text-left rtl:text-right">
                            <tr>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Certificate</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Certificate Number
                                </th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Issue Date</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Expiry Date</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Issuing Authority
                                </th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"></th>

                                <th class="px-4 py-2"></th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            <tr v-for="certificate in certificates" :key="certificate.id">
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{
                            certificate.name }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ certificate.certificate_no
                                    }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ certificate.issue_date }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ certificate.expiry_date
                                    }}</td>


                                <td class="whitespace-nowrap px-4 py-2 text-gray-700"> {{
                            certificate.issuing_authority }}

                                </td>
                            </tr>


                        </tbody>
                    </table>
                </div>
                <!--Certificates-->
                <!--Experiences-->
                <div>
                    <h1>Experiences</h1>
                    <table class="mx-auto divide-y-2 divide-gray-200 bg-white text-sm">
                        <thead class="ltr:text-left rtl:text-right">
                            <tr>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Ship Name</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Flag</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Ship Type</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Rank</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">GRT
                                </th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Trade</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Sign-on</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Sign-off</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            <tr v-for="experience in experiences" :key="experience.id">
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{
                            experience.ship_name }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ experience.flag
                                    }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ experience.ship_type }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ experience.rank
                                    }}</td>


                                <td class="whitespace-nowrap px-4 py-2 text-gray-700"> {{ experience.GRT }}

                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700"> {{ experience.Trade }}

                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700"> {{ experience.sign_on_date }}

                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700"> {{ experience.sign_off_date
                                    }}

                                </td>
                            </tr>


                        </tbody>
                    </table>
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
                                <template #trigger >
                                    <div class="mt-1 px-4 py-2 rounded-md border-2 bg-white text-gray-600 block w-full">
                                    {{selectedType || 'Select document type'}}</div>
                                </template>
                                <template #content >
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
                            <input type="date" v-model="form.document_date"/>
                            <InputError class="mt-2" :message="form.errors.document_date" />
                        </div>
                        <div>
                            <InputLabel>Result</InputLabel>
                            <Dropdown align="left">
                                <template #trigger >
                                    <div class="mt-1 px-4 py-2 rounded-md border-2 bg-white text-gray-600 block w-full">
                                    {{selectedResult || 'Select Result'}}</div>
                                </template>
                                <template #content >
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
                            <input type="file" @input="change"/>
                            <InputError class="mt-2" :message="form.errors.file" />
                        </div>
                        <PrimaryButton>Upload Documents</PrimaryButton>
                    </form>
                </div>
                 <!--Bank Account-->
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
                                <template #trigger >
                                    <div class="mt-1 px-4 py-2 rounded-md border-2 bg-white text-gray-600 block w-full">
                                    {{selectedType || 'Select document type'}}</div>
                                </template>
                                <template #content >
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
                            <input type="date" v-model="form.document_date"/>
                            <InputError class="mt-2" :message="form.errors.document_date" />
                        </div>
                        <div>
                            <InputLabel>Result</InputLabel>
                            <Dropdown align="left">
                                <template #trigger >
                                    <div class="mt-1 px-4 py-2 rounded-md border-2 bg-white text-gray-600 block w-full">
                                    {{selectedResult || 'Select Result'}}</div>
                                </template>
                                <template #content >
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
                            <input type="file" @input="change"/>
                            <InputError class="mt-2" :message="form.errors.file" />
                        </div>
                        <PrimaryButton>Upload Documents</PrimaryButton>
                    </form>
                </div>
            </div>
        </div>


    </AuthenticatedLayout>
</template>
