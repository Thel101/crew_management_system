<script setup>
import { Head, Link } from '@inertiajs/vue3';
import BottomNavigationBar from '@/Components/BottomNavigationBar.vue'
import Register from '@/Pages/Auth/Register.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { onMounted, onUnmounted, ref } from 'vue';
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
        },
        seafarer_count: {
            type: Number
        }
    });
const image_url = '/images/home-seafarer.jpg'
const activeSection = ref('home');
const home = ref(null);
const partners = ref(null);
const vacancies = ref(null);
const about = ref(null);
const observeSection = () => {
    const options = {
        root: null, // Observe the viewport
        threshold: 0.5, // Trigger when 50% of the section is visible
    };
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                activeSection.value = entry.target.id;
            }
        });
    }, options);

    home.value && observer.observe(home.value);
    partners.value && observer.observe(partners.value);
    vacancies.value && observer.observe(vacancies.value);
    about.value && observer.observe(about.value);
}
onMounted(() => {
    observeSection()
})
onUnmounted(() => {
    observer.disconnect();
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
            <Link class="text-xl me-5">Home</Link>
            <Link class="text-xl me-5" href="#partners">Partners</Link>
            <Link class="text-xl me-5" href="#vacancies">Vacancies</Link>
            <Link class="text-xl me-5" href="#about">About Us</Link>

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

    <section id="home" ref="home"
        class="flex flex-row min-h-screen bg-gradient-to-r from-sky-500 to-indigo-500 items-center justify-around">
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
    </section>
    <section id="partners" class="mt-10 pt-10" style="height: 50vh;" ref="partners">
        <h1 class="text-3xl text-center font-light mb-10 mt-20">Our Top Life-long Partners</h1>
        <div class="grid grid-cols-3 gap-x-28 justify-items-stretch md:mx-32 mx-12">
            <div class="bg-gradient-to-r from-gray-400 to-blue-200 shadow-lg hover:bg-white hover:shadow-2xl hover:cursor-pointer px-5 py-8 rounded-lg"
                v-for="vessel in vessels" :key="vessel.id">
                <div class="text-lg text-center">{{ vessel.name }}</div>
                <div class="text-lg text-center">{{ vessel.flag }}</div>
                <div class="text-lg text-center">{{ vessel.type }}</div>

            </div>

        </div>
        <div class="text-center my-4 text-xl">
            Join our crew list to explore around the world
        </div>
        <div class="text-center my-4 text-lg">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla,
            distinctio.
        </div>
    </section>

    <section id="vacancies" class="mt-10 pt-10" ref="vacancies" style="height: 50vh;">
        <h1 class="text-3xl text-blue-600 text-center pt-10 font-semibold mb-10 mt-20">Offering Now!</h1>
        <div class="grid grid-cols-3 gap-x-28 justify-items-stretch md:mx-32 mx-12 mb-10">
            <div class="bg-slate-200 shadow-lg py-8 hover:bg-blue-100 hover:shadow-2xl hover:cursor-pointer rounded-lg"
                v-for="job in jobs" :key="job.id">
                <div class="text-lg text-center">{{ job.role.name }}</div>
                <div class="text-lg text-center">{{ job.description }}</div>
                <div class="text-lg text-center">{{ job.requirements }}</div>
                <div class="text-lg text-center">{{ job.salary }}</div>

            </div>

        </div>
        <div class="mx-auto">

        </div>
    </section>
    <section id="about" ref="about" class="bg-blue-300 flex flex-row mt-5 items-center" style="height: 50vh;">
        <div class="w-1/3">
            <img :src="image_url">
        </div>
        <div class="w-1/3 text-center leading-loose text-l p-5">
            <div>Lorem ipsum dolor sit amet.</div>
            <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque minus eligendi assumenda, debitis ipsum
                labore dolor quam! Repellendus.</div>

        </div>

        <div class="w-1/3 text-center me-10">
            <div class="text-3xl mt-10">Onboarding more than <span class="text-yellow-400">{{ seafarer_count }} </span>
            </div>
            <div class="text-2xl text-center">Since We Started</div>
        </div>
    </section>
    <BottomNavigationBar></BottomNavigationBar>

</template>

<style>
html {
    scroll-behavior: smooth;
}
</style>
