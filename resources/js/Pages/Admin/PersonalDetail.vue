<script setup>
import { popScopeId, ref } from 'vue';
import PersonalText from '@/Components/PersonalText.vue'
const props = defineProps({
    fullname: String,
    nationality: String,
    religion: String,
    dob: String,
    height: String,
    weight: String,
    mobile_no: String,
    email: String,
    next_of_kin: String,
    relationship: String,
    next_of_kin_phone: String,
    passport: {
        type: Object
    },
    seaman_book: String,
    book_place_of_issue: String,
    book_issue_date: String,
    status: String
})


</script>

<template>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden">
            <div>

                <div class="">
                    <div class="flex flex-row">
                        <h1 class="text-2xl font-semi-bold ">Personal Details</h1>
                        <span class="bg-yellow-300 mt-2 rounded-md ms-3 px-3 text-sm self-start"
                            v-if="props.status == 'new'">{{
                                props.status }}
                        </span>
                    </div>

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
                        <PersonalText :label="'Passport Number'" :text="props.passport.passport_no"></PersonalText>
                        <PersonalText :label="'Place of issue'" :text="props.passport.place_of_issue"></PersonalText>
                        <PersonalText :label="'Issue Date'" :text="props.passport.issue_date"></PersonalText>
                        <PersonalText :label="'Expiry Date'" :text="props.passport.expiry_date"></PersonalText>
                        <button v-show="$page.props.auth.user.role != 'user' && props.status != 'new'"><a
                                :href="route('passport.edit', props.passport.id)"
                                class="bg-blue-400 rounded-md p-1">edit {{ props.status }}</a></button>
                    </div>

                    <div class="w-1/2">
                        <h1 class="text-2xl font-semi-bold my-2">Seaman Book</h1>
                        <PersonalText :label="'Seaman book No'" :text="props.seaman_book"></PersonalText>
                        <PersonalText :label="'Place of issue'" :text="props.book_place_of_issue"></PersonalText>
                        <PersonalText :label="'Issue Date'" :text="props.book_issue_date"></PersonalText>

                    </div>

                </div>

            </div>
            <!-- <a target="__blank" :href="route('applicant.pdf', applicant.id)">
                    Save as PDF
                </a> -->

        </div>
    </div>

</template>
