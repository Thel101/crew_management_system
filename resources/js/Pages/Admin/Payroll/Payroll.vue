<script setup>
import { useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
const props = defineProps({
    seafarer_id: {
        type: Number
    }
})

const form = useForm({
    seafarer_id : props.seafarer_id,
    base_salary: '',
    bonus: '',
    overtime_pay: '',
    deduction: '',
    total_salary: '',
    start_date: '',
    end_date: '',
})
const calculatePayroll = ()=>{
    form.post(route('payroll.calculate'),{
        onSuccess: ()=>{
            form.reset();
            console.log('success')
        }
    })
}
</script>
<template>
    <div>
        <form @submit.prevent="calculatePayroll">
            <div class="flex flex-row">
                <div class="w-1/3 me-2">
                    <InputLabel class="w-full">Basis Salary</InputLabel>
                    <TextInput class="w-full" v-model="form.base_salary"></TextInput>
                    <InputError class="mt-2" :message="form.errors.base_salary" />
                </div>
                <div class="w-1/3 mx-2">
                    <InputLabel class="w-full">Bonus Pay</InputLabel>
                    <TextInput class="w-full" v-model="form.bonus"></TextInput>
                    <InputError class="mt-2" :message="form.errors.bonus" />
                </div>
                <div class="w-1/3 ms-2">
                    <InputLabel class="w-full">Overtime Pay</InputLabel>
                    <TextInput class="w-full" v-model="form.overtime_pay"></TextInput>
                    <InputError class="mt-2" :message="form.errors.overtime_pay" />
                </div>
            </div>
            <div class="flex flex-row">
                <div class="w-1/3 me-2">
                    <InputLabel class="w-full">Deduction</InputLabel>
                    <TextInput class="w-full" v-model="form.deduction"></TextInput>
                    <InputError class="mt-2" :message="form.errors.deduction" />
                </div>

                <div class="w-1/3 mx-2">
                    <InputLabel class="w-full">Payroll Start Date</InputLabel>
                    <input class="w-full rounded-md border-gray-300 shadow-sm" type="date" v-model="form.start_date" />
                    <InputError class="mt-2" :message="form.errors.start_date" />
                </div>
                <div class="w-1/3 ms-2">
                    <InputLabel class="w-full">Payroll End Date</InputLabel>
                    <input class="w-full rounded-md border-gray-300 shadow-sm" type="date" v-model="form.end_date" />
                    <InputError class="mt-2" :message="form.errors.end_date" />
                </div>
            </div>

            <PrimaryButton class="my-2">Calculate Payroll</PrimaryButton>
        </form>
    </div>
</template>
