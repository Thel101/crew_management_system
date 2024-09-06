<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PassportForm from '@/Pages/User/PassportForm.vue';
const props = defineProps({
    seafarer_id: {
        type: String
    }
})
</script>
<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Seafarers</h2>
        </template>
        <PassportForm :seafarer_id="seafarer_id"></PassportForm>
    </AuthenticatedLayout>
</template>
