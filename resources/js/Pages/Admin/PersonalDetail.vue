<script setup>

import PersonalText from '@/Components/PersonalText.vue'
const props = defineProps([
    'fullname',
    'nationality',
    'religion',
    'dob',
    'height',
    'weight',
    'mobile_no',
    'email',
    'next_of_kin',
    'relationship',
    'next_of_kin_phone',
    'passport_no',
    'place_of_issue',
    'issue_date',
    'expiry_date',
    'seaman_book',
    'book_place_of_issue',
    'book_issue_date'

])

</script>

<template>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden">
            <div>

                <div class="">

                    <h1 class="text-2xl font-semi-bold ">Personal Details</h1>
                    <div id="pdf-content" class="max-w-7xl">
                        <div class="flex flex-row">
                            <PersonalText class="w-1/2" :label="'Name'" :text="props.fullname"></PersonalText>
                            <PersonalText class="w-1/2" :label="'Date of Birth'" :text="props.dob"></PersonalText>
                        </div>
                        <div class="flex flex-row">
                            <PersonalText class="w-1/2" :label="'Nationality'" :text="props.nationality"></PersonalText>
                            <PersonalText class="w-1/3" :label="'Religion'" :text="props.religion"></PersonalText>
                        </div>

                        <div class="flex flex-row">
                            <PersonalText class="w-1/2" :label="'Height'" :text="props.height"></PersonalText>
                            <PersonalText class="w-1/2" :label="'Weight'" :text="props.weight"></PersonalText>

                        </div>
                        <div class="flex flex-row max-w-7xl">
                            <PersonalText class="w-1/2" :label="'Mobile Number'" :text="props.mobile_no"></PersonalText>
                            <PersonalText class="w-1/2" :label="'Email'" :text="props.email"></PersonalText>

                        </div>
                        <div class="flex flex-row">
                            <PersonalText class="w-1/2" :label="'Contact Person'"
                                :text="`${props.next_of_kin} (${props.relationship})`"></PersonalText>
                            <PersonalText class="w-1/2" :label="'Contact Person Mobile'"
                                :text="props.next_of_kin_phone"></PersonalText>

                        </div>
                    </div>
                </div>
                <hr class="h-8">
                <div class="flex flex-row">
                    <div class="w-1/2">

                        <h1 class="text-2xl font-semi-bold my-2">Passport</h1>

                        <PersonalText :label="'Passport Number'" :text="props.passport_no"></PersonalText>
                        <PersonalText :label="'Place of issue'" :text="props.place_of_issue"></PersonalText>
                        <PersonalText :label="'Issue Date'" :text="props.issue_date"></PersonalText>
                        <PersonalText :label="'Expiry Date'" :text="props.expiry_date"></PersonalText>
                    </div>
                    <div class="w-1/2">
                        <h1 class="text-2xl font-semi-bold my-2">Seaman Book</h1>
                        <PersonalText :label="'Seaman book No'" :text="props.seaman_book"></PersonalText>
                        <PersonalText :label="'Place of issue'" :text="props.place_of_issue"></PersonalText>
                        <PersonalText :label="'Issue Date'" :text="props.issue_date"></PersonalText>

                    </div>

                </div>
            </div>
            <!-- <a target="__blank" :href="route('applicant.pdf', applicant.id)">
                    Save as PDF
                </a> -->

        </div>
    </div>

</template>
