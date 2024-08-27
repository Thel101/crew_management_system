<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import PersonalDetails from '../Admin/PersonalDetail.vue';
const open = ref(false)

const props = defineProps({
    applicant:
    {
        type: Object
    },
    jobs:{
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


</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <div class="flex flex-row">
                        <img :src="`/storage/images/${applicant.profile}`" class="w-48 h-48 rounded-md" />
                        <PersonalDetails :fullname="props.applicant.fullname"
                        :expected_salary="props.applicant.expected_salary"
                        :nationality="props.applicant.nationality"
                        :religion="props.applicant.religion"
                        :dob="props.applicant.dob"
                        :height="props.applicant.height"
                        :weight="props.applicant.weight"
                        :mobile_no="props.applicant.mobile_no"
                        :email="props.applicant.email"
                        :next_of_kin="props.applicant.next_of_kin"
                        :relationship="props.applicant.relationship"
                        :next_of_kin_phone="props.applicant.next_of_kin_mobile"></PersonalDetails>
                    </div>
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
                    <hr>
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
                    <a target="__blank" :href="route('applicant.pdf', applicant.id)">
                        Save as PDF
                    </a>

                </div>
            </div>
        </div>


    </AuthenticatedLayout>
</template>
