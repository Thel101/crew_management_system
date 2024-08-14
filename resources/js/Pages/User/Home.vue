<script setup>
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    vacancies: {
        type: Object
    }
});
</script>

<template>

    <Head title="CMS" />

    <div class="sm:flex sm:justify-center sm:items-center min-h-screen bg-center bg-blue-900">
        <div class="flex flex-col items-center">
            <img src="/images/logo1.jpeg" alt="" class="w-16 h-16 text-center">
            <h1 class="text-3xl text-white mt-5">Crew Management System</h1>
            <Link :href="route('logout')" as="button" method="post">
            Log out
            </Link>
            <div class="grid grid-cols-2 gap-4 w-4/5 mt-10">
                <div v-for="vacancy in vacancies" :key="vacancy.id"
                    class="relative bg-white rounded-md text-center px-3 py-7 text-lg group min-w-3xl">
                    <div class="group-hover:opacity-20 transition-opacity duration-300">{{ vacancy.role.name }}</div>
                    <div class="group-hover:opacity-20 transition-opacity duration-300">{{ vacancy.description }}</div>
                    <div class="group-hover:opacity-20 transition-opacity duration-300 font-bold">{{ vacancy.vessel.name
                        }}
                    </div>
                    <div class="absolute top-12 right-2 left-2">
                        <Link :href="route('cvforms.index', vacancy.id)"><button
                            class="bg-blue-300 rounded-full px-4 py-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">Apply
                            Now</button>
                        </Link>

                    </div>
                </div>

            </div>
        </div>

    </div>
</template>

<style>
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
