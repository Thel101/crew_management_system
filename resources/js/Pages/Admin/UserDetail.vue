<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TableCell from '@/Components/TableCell.vue';
const props = defineProps({
    user:
    {
        type: Object
    },
    cvform: {
        type: Object
    },
    passport: {
        type: Object
    },
    seaman_book: {
        type: Object
    },
    certificates: {
        type: Array
    },
    experiences: {
        type: Array
    },
    vacancies: {
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
                        <img :src="`/storage/images/${cvform.profile_pic}`" class="w-48 h-48 rounded-md" />
                        <div class="ml-10">
                            <h1>Personal Details</h1>
                            <ul>
                                <li v-for="vacancy in vacancies" :key="vacancy.id">
                                    Applied Position: {{ vacancy.description }} , {{ vacancy.role.name }}
                                </li>
                            </ul>
                            <div class="flex flex-row">
                                <div>
                                    Name <span>{{ cvform.fullname }}</span>
                                </div>

                                <div>
                                    Rank <span>{{ cvform.rank }}</span>
                                </div>
                                <div>
                                    Expected Salary <span>{{ cvform.expected_salary }}</span>
                                </div>

                                <div>
                                    Nationality <span>{{ cvform.nationality }}</span>
                                </div>
                                <div>
                                    Religion <span>{{ cvform.religion }}</span>
                                </div>


                            </div>
                            <div class="flex flex-row">
                                <div>
                                    Date of birth <span>{{ cvform.dob }}</span>
                                </div>

                                <div>
                                    Place of brith <span>{{ cvform.place_of_birth }}</span>
                                </div>
                                <div>
                                    Height <span>{{ cvform.height }}</span>
                                </div>

                                <div>
                                    Weight <span>{{ cvform.weight }}</span>
                                </div>
                                <div>
                                    Overall size <span>{{ cvform.overall_size }}</span>
                                </div>
                                <div>
                                    Safety shoe size <span>{{ cvform.safety_shoe_size }}</span>
                                </div>


                            </div>
                            <div class="flex flex-row">
                                <div>
                                    Mobile Number <span>{{ cvform.mobile_no }}</span>
                                </div>

                                <div>
                                    Email <span>{{ cvform.email }}</span>
                                </div>

                            </div>
                            <div class="flex flex-row">
                                <div>
                                    Next of Kin <span>{{ cvform.next_of_kin }}</span>
                                </div>

                                <div>
                                    Relationship <span>{{ cvform.relationship }}</span>
                                </div>
                                <div>
                                    Next of Kin Phone <span>{{ cvform.next_of_kin_phone }}</span>
                                </div>
                                <div>
                                    Email <span>{{ cvform.next_of_kin_email }}</span>
                                </div>
                                <div>
                                    Address <span>{{ cvform.next_of_kin_address }}</span>
                                </div>

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
                            <div>Seaman book No: {{ seaman_book.seaman_book }}</div>
                            <div>Place of issue: {{ seaman_book.place_of_issue }}</div>
                            <div>Issue Date {{ seaman_book.issue_date }}</div>
                            <div>Expriy Date {{ seaman_book.expiry_date }}</div>
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
        </div>


    </AuthenticatedLayout>
</template>
