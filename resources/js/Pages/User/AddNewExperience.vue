<script setup>
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue'
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { ref, defineEmits } from 'vue';
import { useForm, usePage, router } from '@inertiajs/vue3';


const emit = defineEmits(['experienceAdded']);
const props = defineProps({
    'seafarer_id': ''
})

const experiences = useForm({
    experiences: [
        {
            seafarer_id: props.seafarer_id,
            ship_name: '',
            flag: '',
            ship_type: '',
            rank: '',
            GRT: '',
            engine_make: '',
            trade: '',
            sign_on_date: '',
            sign_off_date: ''

        }
    ]
})

const today = new Date().toISOString().split('T')[0];
const submit = () => {
    experiences.post(route('experiences.store'), {
        onSuccess: () => {
            emit('experienceAdded');

        }
    })
}
</script>
<template>

    <div>
        <div v-for="(experience, index) in experiences.experiences" :key="index" class="flex flex-col gap-2 mt-2">
            <div class="flex flex-row">
                <div class="w-1/3 mr-3">
                    <InputLabel for="ship_name">Ship Name</InputLabel>
                    <TextInput id="ship_name" type="text" class="mt-1 block w-full" v-model="experience.ship_name" />
                    <InputError>{{ experience.errors.ship_name }}</InputError>
                </div>
                <div class="w-1/3 mr-3">
                    <InputLabel for="flag">Ship Flag</InputLabel>
                    <TextInput id="flag" type="text" class="mt-1 block w-full" v-model="experience.flag" />
                    <InputError>{{ experience.errors.flag }}</InputError>
                </div>
                <div class="w-1/3">
                    <InputLabel for="type">Ship Type</InputLabel>
                    <TextInput id="type" type="text" class="mt-1 block w-full" v-model="experience.ship_type" />
                    <InputError>{{ experience.errors.ship_type }}</InputError>
                </div>
            </div>
            <div class="flex flex-row">

                <div class="w-1/3 mr-3">
                    <InputLabel for="rank">Rank</InputLabel>
                    <TextInput id="rank" type="text" class="mt-1 block w-full" v-model="experience.rank" />
                    <InputError>{{ experience.errors.rank }}</InputError>
                </div>
                <div class="w-1/3 mr-3">
                    <InputLabel for="grt">Ship GRT</InputLabel>
                    <TextInput id="grt" type="text" class="mt-1 block w-full" v-model="experience.GRT" />
                    <InputError>{{ experience.errors.GRT }}</InputError>
                </div>
                <div class="w-1/3">
                    <InputLabel for="trade">Trade</InputLabel>
                    <TextInput id="trade" type="text" class="mt-1 block w-full" v-model="experience.trade" />
                    <InputError>{{ experience.errors.trade }}</InputError>
                </div>
            </div>

            <div class="flex flex-row">
                <div class="w-1/3 mr-3">
                    <InputLabel for="sign_on">Sign On Date</InputLabel>
                    <TextInput id="sign_on" :max="today" type="date" class="mt-1 block w-full"
                        v-model="experience.sign_on_date" />
                    <InputError>{{ experience.errors.flag }}</InputError>
                </div>
                <div class="w-1/3">
                    <InputLabel for="sign_off">Sign Off Date</InputLabel>
                    <TextInput id="sign_off" :max="today" type="date" class="mt-1 block w-full"
                        v-model="experience.sign_off_date" />
                    <InputError>{{ experience.errors.flag }}</InputError>
                </div>
            </div>
        </div>

        <PrimaryButton @click="submit" class="my-2">Add New Experience</PrimaryButton>

    </div>


</template>
