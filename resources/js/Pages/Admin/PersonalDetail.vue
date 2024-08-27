<script setup>

import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps([
    'fullname',
    'expected_salary',
    'nationality',
    'religion',
    'dob',
    'height',
    'weight',
    'mobile_no',
    'email',
    'next_of_kin',
    'relationship',
    'next_of_kin_phone'
])

</script>

<template>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="flex flex-row">

                    <div class="ml-10">

                    <h1>Personal Details</h1>


                    <div class="flex flex-row" id="pdf-content">
                        <div>
                            Name <span>{{ fullname }}</span>
                        </div>

                        <div>
                            Expected Salary <span>{{ expected_salary }}</span>
                        </div>

                        <div>
                            Nationality <span>{{ nationality }}</span>
                        </div>
                        <div>
                            Religion <span>{{ religion }}</span>
                        </div>


                    </div>
                    <div class="flex flex-row">
                        <div>
                            Date of birth <span>{{ dob }}</span>
                        </div>


                        <div>
                            Height <span>{{ height }}</span>
                        </div>

                        <div>
                            Weight <span>{{ weight }}</span>
                        </div>

                    </div>
                    <div class="flex flex-row">
                        <div>
                            Mobile Number <span>{{ mobile_no }}</span>
                        </div>

                        <div>
                            Email <span>{{ email }}</span>
                        </div>

                    </div>
                    <div class="flex flex-row">
                        <div>
                            Next of Kin <span>{{ next_of_kin }}</span>
                        </div>

                        <div>
                            Relationship <span>{{ relationship }}</span>
                        </div>
                        <div>
                            Next of Kin Phone <span>{{ next_of_kin_phone }}</span>
                        </div>

                    </div>
                    </div>
                </div>

                <!-- <a target="__blank" :href="route('applicant.pdf', applicant.id)">
                    Save as PDF
                </a> -->

            </div>
        </div>
    </div>


</template>
