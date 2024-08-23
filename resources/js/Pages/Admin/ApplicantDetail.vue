<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref } from 'vue';
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'


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
                        <div class="ml-10">
                            <TransitionRoot as="template" :show="open">
                                <Dialog class="relative z-10" @close="open = false">
                                    <TransitionChild as="template" enter="ease-out" enter-from="opacity-0"
                                        enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100"
                                        leave-to="opacity-0">
                                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
                                    </TransitionChild>

                                    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                                        <div
                                            class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                            <TransitionChild as="template" enter="ease-out duration-300"
                                                enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                enter-to="opacity-100 translate-y-0 sm:scale-100"
                                                leave="ease-in duration-200"
                                                leave-from="opacity-100 translate-y-0 sm:scale-100"
                                                leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                                                <DialogPanel
                                                    class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                                                        <div class="sm:flex sm:items-start">
                                                            <div
                                                                class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" class="size-6">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                                                                </svg>

                                                            </div>
                                                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                                                <DialogTitle as="h3"
                                                                    class="text-base font-semibold leading-6 text-gray-900">
                                                                    Accept Application</DialogTitle>
                                                                <div class="mt-2">
                                                                    <p class="text-sm text-gray-500">Are you sure you
                                                                        want to accept the application from this user?.
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                                        <button type="button"
                                                            class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto"
                                                            @click="changeUserRole">Accept</button>
                                                        <button type="button"
                                                            class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto"
                                                            @click="open = false" ref="cancelButtonRef">Cancel</button>
                                                    </div>
                                                </DialogPanel>
                                            </TransitionChild>
                                        </div>
                                    </div>
                                </Dialog>
                            </TransitionRoot>
                            <h1>Personal Details</h1>


                            <div class="flex flex-row">
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
                    <!-- <Link method="patch" as="button" :href="route('applicant.status', applicant.id)">
                        <PrimaryButton>Accept</PrimaryButton>
                    </Link> -->

                </div>
            </div>
        </div>


    </AuthenticatedLayout>
</template>
