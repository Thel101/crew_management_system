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
                <div class="overflow-hidden shadow-sm sm:rounded-lg">


                    <div class="flex justify-center">
                        <div class="bg-blue-200 me-10">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6 w-16 h-16">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>

                        </div>
                        <div>
                            <h1 class="my-2 text-xl">Personal Details</h1>
                            <div class="flex flex-row gap-2 my-2">
                                <div class="w-1/3">

                                    <div>
                                        <span class="mr-2 font-bold">Full Name</span>
                                        <span>{{ user.name }}</span>
                                    </div>
                                </div>
                                <div class="w-1/3">
                                    <span class="mr-2 font-bold">Applied Rank</span>
                                    <span>{{ cvform.rank }}</span>

                                </div>
                                <div class="w-1/3">
                                    <span class="mr-2 font-bold">Expected Salary</span>
                                    <span>{{ cvform.expected_salary }}</span>
                                </div>
                            </div>
                            <div class="flex flex-row gap-2 my-2">
                                <div class="w-1/2">
                                    <span class="mr-2 font-bold">Nationality</span>
                                    <span>{{ cvform.nationality }}</span>
                                </div>
                                <div class="w-1/2">
                                    <span class="mr-2 font-bold">Religion</span>
                                    <span>{{ cvform.religion }}</span>

                                </div>
                            </div>
                            <div class="flex flex-row gap-2 my-2">

                                <div class="mt-1 w-1/2">
                                    <span class="mr-2 font-bold">Date Of Birth</span>
                                    <span>{{ cvform.dob }}</span>
                                </div>
                                <div class="w-1/2">
                                    <span class="mr-2 font-bold">Place of Birth</span>
                                    <span>{{ cvform.place_of_birth }}</span>

                                </div>

                            </div>
                            <div class="flex flex-row gap-2 my-2">
                                <div class="w-1/4">
                                    <span class="mr-2 font-bold">Height</span>
                                    <span>{{ cvform.height }}</span>
                                </div>
                                <div class="w-1/4">
                                    <span class="mr-2 font-bold">Weight</span>
                                    <span>{{ cvform.weight }}</span>

                                </div>
                                <div class="w-1/4">
                                    <span class="mr-2 font-bold">Overall size</span>
                                    <span>{{ cvform.overall_size }}</span>
                                </div>

                                <div class="w-48">
                                    <span class="mr-2 font-bold">Safety Shoe Size</span>
                                    <span>{{ cvform.safety_shoe_size }}</span>

                                </div>

                            </div>
                            <div class="flex flex-row gap-2 my-2">
                                <div class="w-1/2">
                                    <span class="mr-2 font-bold">Mobile Number</span>
                                    <span>{{ cvform.mobile_no }}</span>
                                </div>
                                <div>
                                    <span class="mr-2 font-bold">Email Address</span>
                                    <span>{{ cvform.email }}</span>
                                </div>
                            </div>
                            <div class="flex flex-row gap-2 my-2">
                                <div>
                                    <span class="mr-2 font-bold">Next Of Kin</span>
                                    <span>{{ cvform.next_of_kin }}</span>

                                </div>
                                <div>
                                    <span class="mr-2 font-bold">Relationship</span>
                                    <span>{{ cvform.relationship }}</span>

                                </div>
                                <div>
                                    <span class="mr-2 font-bold">Next of Kin Mobile</span>
                                    <span>{{ cvform.next_of_kin_mobile }}</span>
                                </div>
                            </div>
                            <div class="flex flex-row gap-2 my-2">
                                <div class="w-1/3">
                                    <span class="mr-2 font-bold">Next of Kin Email</span>
                                    <span>{{ cvform.next_of_kin_email }}</span>

                                </div>
                                <div class="w-2/3">
                                    <span class="mr-2 font-bold">Next of Kin Address</span>
                                    <span>{{ cvform.next_of_kin_address }}</span>

                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="flex justify-center">

                        <div class="me-80">
                            <h1 class="text-xl font-bold">Passport</h1>
                            <div>
                                <span class="mr-2 font-bold">Passport No</span>
                                <span>{{ passport.passport_no }}</span>
                            </div>
                            <div>
                                <span class="mr-2 font-bold">Place of Issue</span>
                                <span>{{ passport.place_of_issue }}</span>
                            </div>

                            <div>
                                <span class="mr-2 font-bold">Issue Date</span>
                                <span>{{ passport.issue_date }}</span>
                            </div>
                            <div>
                                <span class="mr-2 font-bold">Expiry Date</span>
                                <span>{{ passport.expiry_date }}</span>
                            </div>

                        </div>
                        <div>
                            <h1 class="text-xl font-bold">Seaman Book</h1>
                            <div>
                                <span class="mr-2 font-bold">Seaman book no:</span>
                                <span>{{ seaman_book.seaman_book }}</span>
                            </div>
                            <div>
                                <span class="mr-2 font-bold">Place of Issue</span>
                                <span>{{ seaman_book.place_of_issue }}</span>
                            </div>

                            <div>
                                <span class="mr-2 font-bold">Issue Date</span>
                                <span>{{ seaman_book.issue_date }}</span>
                            </div>
                            <div>
                                <span class="mr-2 font-bold">Expiry Date</span>
                                <span>{{ seaman_book.expiry_date }}</span>
                            </div>

                        </div>
                    </div>

                    <div class="flex flex-col items-center">
                        <h1 class="text-xl font-bold mx-auto align-self-start">Certificates</h1>
                        <table class="table-auto">
                            <thead class="border-0 border-b-2 border-slate-500">
                                <th class="px-2">Certificate Name</th>
                                <th class="px-4 text-center">Certificate Number</th>
                                <th class="px-4 text-center">Issuing Authority</th>
                                <th class="px-4 text-center">Issue date</th>
                                <th class="px-4 text-center">Expiry date</th>
                            </thead>
                            <tbody>
                                <tr v-for="certificate in certificates" :key="certificate.id">
                                    <td class="text-center">{{ certificate.name }}</td>
                                    <td class="text-center">{{ certificate.certificate_no }}</td>
                                    <td class="text-center">{{ certificate.issue_date }}</td>
                                    <td class="text-center">{{ certificate.expiry_date }}</td>
                                    <td class="text-center">{{ certificate.issuing_authority }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>


    </AuthenticatedLayout>
</template>
