<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SeafarerEdit from '@/Components/SeafarerEdit.vue';


const props = defineProps({

    roles: {
        type: Array
    },
    seafarer: {
        type: Object
    },
    passport: {
        type: Object
    }

});


</script>

<template>
    <AuthenticatedLayout>

        <Head title="CMS" />
        <div class="flex flex-row justify-between">
            <h1 class="text-xl ms-24">Seafarer Personal Information Edit page</h1>
            <a href="#" class="me-24 text-blue-600 text-lg underline" onclick="history.back()">Back</a>
        </div>

        <SeafarerEdit :seafarer="props.seafarer" :roles="props.roles" :props="props" />

    </AuthenticatedLayout>
</template>

<style>
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
