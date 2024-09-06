<script setup>
import { Head, Link } from '@inertiajs/vue3';
import BottomNavigationBar from '@/Components/BottomNavigationBar.vue'
import Register from '@/Pages/Auth/Register.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
defineProps
({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    vessels: {
        type: Object
    },
    jobs: {
        type: Object
    }
});
</script>

<template>

    <Head title="Welcome" />

    <div
        class="flex flex-row items-center justify-between bg-gradient-to-r from-sky-700 to-indigo-500 p-3 text-white fixed top-0 left-0 right-0">
        <div class="flex flex-row">
            <h1 class="text-2xl mt-2">Crew Management System</h1>
        </div>
        <div class="flex flex-row">
            <Link :class="{ 'text-xl me-5 underline': $page.url === '/', 'text-xl me-5': $page.url != '/' }">Home</Link>
            <Link
                :class="{ 'text-xl me-5 underline': $page.url === '/#vacancies', 'text-xl me-5': $page.url != '/#vacancies' }"
                href="#vacancies">Vacancies</Link>
            <Link
                :class="{ 'text-xl me-5 underline': $page.url === '/#about', 'text-xl me-5': $page.url != '/#about' }"
                href="#about">About Us</Link>
            <Link
                :class="{ 'text-xl me-5 underline': $page.url === '/#partners', 'text-xl me-5': $page.url != '/#partners' }"
                href="#partners">Partners</Link>
            <!--  -->
        </div>
        <div v-if="canLogin">
            <button v-if="$page.props.auth.user">
                <Link :href="route('seafarer.profile', $page.props.auth.user.id)"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-900 dark:hover:text-gray-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                Profile |</Link>
                <Link method="post" :href="route('logout')"
                    class="ms-2 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-900 dark:hover:text-gray-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                Log out</Link>

            </button>

            <template v-else>
                <div>
                    <button class="rounded-full bg-orange-200 px-10 py-3 hover:bg-white">
                        <Link :href="route('login')" class="font-semibold text-gray-600 dark:text-gray-900">
                        Log in</Link>
                    </button>
                </div>
            </template>
        </div>


    </div>

    <div class="flex flex-row min-h-screen bg-gradient-to-r from-sky-500 to-indigo-500 items-center justify-around">
        <div class="ms-5 px-5">
            <div class="text-3xl text-white leading-10">Join us to engage</div>
            <div class="text-3xl text-white leading-10">in best seafarership working experience</div>
            <span class="text-slate-300 leading-10">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat,
                veniam.</span>
        </div>
        <div class="bg-white rounded-md shadow-md px-10 py-4">
            <h1 class="text-xl font-semibold text-center">Register Now!</h1>
            <Register></Register>
        </div>
    </div>
    <div id="partners">
        <h1 class="text-3xl text-center font-semibold my-5">Our Top Life-long Partners</h1>
        <div class="grid grid-cols-3 gap-x-10 justify-items-stretch md:mx-32 mx-12">
            <div class="bg-gradient-to-r from-blue-200 to-blue-500 shadow-lg p-5 rounded-lg" v-for="vessel in vessels"
                :key="vessel.id">
                <div class="text-lg text-center">{{ vessel.name }}</div>
                <div class="text-lg text-center">{{ vessel.flag }}</div>
                <div class="text-lg text-center">{{ vessel.type }}</div>

            </div>
        </div>
    </div>

    <div id="#vacancies">
        Vacancy
    </div>
    <div id="#about">
        About
    </div>
    <BottomNavigationBar></BottomNavigationBar>

</template>

<style>
/* .bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
} */
</style>
