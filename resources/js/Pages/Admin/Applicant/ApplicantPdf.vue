<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref } from 'vue';
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { Inertia } from '@inertiajs/inertia';

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

const printme = () => {
  window.print()
};

</script>

<template>

    <Head title="Applicant CV" />


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <div class="flex flex-row">
                        <img :src="`/storage/images/${applicant.profile}`" class="w-48 h-48 rounded-md" />
                        <div class="ml-10">

                            <h1>Personal Details</h1>

                            <div>
                                <div class="flex flex-row" id="pdf-content">
                                <div>
                                    Name <span>{{ applicant.fullname }}</span>
                                </div>

                                <div>
                                    Rank <span>{{ applicant.rank }}</span>
                                </div>
                                <div>
                                    Expected Salary <span>{{ applicant.expected_salary }}</span>
                                </div>

                                <div>
                                    Nationality <span>{{ applicant.nationality }}</span>
                                </div>
                                <div>
                                    Religion <span>{{ applicant.religion }}</span>
                                </div>


                            </div>
                            <div class="flex flex-row">
                                <div>
                                    Date of birth <span>{{ applicant.dob }}</span>
                                </div>


                                <div>
                                    Height <span>{{ applicant.height }}</span>
                                </div>

                                <div>
                                    Weight <span>{{ applicant.weight }}</span>
                                </div>

                            </div>
                            <div class="flex flex-row">
                                <div>
                                    Mobile Number <span>{{ applicant.mobile_no }}</span>
                                </div>

                                <div>
                                    Email <span>{{ applicant.email }}</span>
                                </div>

                            </div>
                            <div class="flex flex-row">
                                <div>
                                    Next of Kin <span>{{ applicant.next_of_kin }}</span>
                                </div>

                                <div>
                                    Relationship <span>{{ applicant.relationship }}</span>
                                </div>
                                <div>
                                    Next of Kin Phone <span>{{ applicant.next_of_kin_phone }}</span>
                                </div>

                            </div>
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


                        </div>
                    </div>

                    <a href="" target="__blank" @click.prevent="printme">Print</a>

                </div>
            </div>
        </div>



</template>
