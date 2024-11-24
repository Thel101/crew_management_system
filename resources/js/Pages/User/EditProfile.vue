<script setup>
import SeafarerEdit from '@/Components/SeafarerEdit.vue';
const props = defineProps({
    seafarer: {
        type: Object
    },
    roles: {
        type: Array
    },
    passport: {
        type: Object
    }
})
</script>
<template>
    <div class="flex flex-col items-center bg-gradient-to-r from-sky-700 to-indigo-500 p-3">
        <img src="/images/logo1.jpeg" alt="" class="w-16 h-16 text-center">
        <h1 class="text-3xl text-white mt-5">Crew Management System</h1>
    </div>
    <div class="p-5 bg-white rounded-md border-slate-500 shadow-md m-5 max-w-5xl mx-auto">
        <a href="#" class="ms-6 text-blue-600 text-lg underline" onclick="history.back()">Back</a>
        <SeafarerEdit :seafarer="props.seafarer" :roles="props.roles" :props="props" />

    </div>
</template>
