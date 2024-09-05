<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PersonalDetails from '@/Pages/User/PersonalDetails.vue';
</script>
<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Seafarers</h2>
        </template>
        <PersonalDetails></PersonalDetails>
    </AuthenticatedLayout>
</template>
