<script setup>

import PersonalText from '@/Components/PersonalText.vue'
import EditModal from './Seafarer/EditModal.vue';
import { ref } from 'vue';
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
                    <div class="flex flex-row">
                        <h1 class="text-2xl font-semi-bold ">Personal Details</h1>
                        <div class="my-2 ms-10"><button @click="openModal"><svg  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6 hover:cursor-pointer">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg></button>
                            </div>
                    </div>


                    <div id="pdf-content" class="max-w-7xl">
                        <div class="flex flex-row">
                            <PersonalText :label="'Name'" :text="props.fullname"></PersonalText>
                        </div>
                        <div class="flex flex-row">
                            <PersonalText class="w-1/2" :label="'Nationality'" :text="props.nationality"></PersonalText>
                            <PersonalText class="w-1/3" :label="'Religion'" :text="props.religion"></PersonalText>
                        </div>

                        <div class="flex flex-row">
                            <PersonalText class="w-1/2" :label="'Height'" :text="props.height"></PersonalText>
                            <PersonalText class="w-1/2" :label="'Weight'" :text="props.height"></PersonalText>

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
