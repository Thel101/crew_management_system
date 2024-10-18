<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3';
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
const observer = ref(null);
const observeSection = () => {
    const options = {
        root: null, // Observe the viewport
        threshold: 0.5, // Trigger when 50% of the section is visible
    };
    observer.value = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                activeSection.value = entry.target.id;
            }
        });
    }, options);

    home.value && observer.value.observe(home.value);
    partners.value && observer.value.observe(partners.value);
    vacancies.value && observer.value.observe(vacancies.value);
    about.value && observer.value.observe(about.value);
}
onMounted(() => {
    observeSection()
})
onUnmounted(() => {
    observer.value.disconnect();
});
const scrollToSection = (sectionId) => {
    const element = document.getElementById(sectionId);
    if (element) {
        element.scrollIntoView({ behavior: 'smooth' });
    }
}
const showingNavigationDropdown = ref(false)

</script>

<template>

    <Head title="Welcome" style="margin-top: 0; padding-top: 0;" />
    <div class="overflow-hidden">
        <div
            class="md:fixed top-0 left-0 right-0 static md:flex justify-between items-center bg-gradient-to-r from-sky-700 to-indigo-500 p-2 text-white">
            <div class="flex items-center pt-3">
                <h1 class="text-2xl">Crew Management System</h1>
                <span class="me-2 items-center md:hidden">
                    <button @click="showingNavigationDropdown = !showingNavigationDropdown"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{
                                hidden: showingNavigationDropdown,
                                'inline-flex': !showingNavigationDropdown,
                            }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{
                                hidden: !showingNavigationDropdown,
                                'inline-flex': showingNavigationDropdown,
                            }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </span>
            </div>

            <ul class="md:flex md:items-center md:static absolute md:w-auto w-full top-20 md:bg-transparent bg-blue-400 duration-700 ease-in p-3"
                :class="[showingNavigationDropdown ? 'left-0' : 'left-[-100%]']">
                <li class="md:my-0 my-6">
                    <Link class="text-xl me-5">Home</Link>
                </li>
                <li class="md:my-0 my-6">
                    <Link class="text-xl me-5" href="#partners">Partners</Link>
                </li>
                <li class="md:my-0 my-6">
                    <Link class="text-xl me-5" href="#vacancies">Vacancies</Link>
                </li>
                <li class="md:my-0 my-6">
                    <Link class="text-xl me-5" href="#about">About Us</Link>
                </li>
                <div v-if="canLogin">
                    <button v-if="$page.props.auth.user">


                        <button class="rounded-full bg-orange-200 px-10 py-3 hover:bg-white">
                            <Link method="post" :href="route('logout')"
                                class="font-semibold text-gray-600 dark:text-gray-900">
                            Log out</Link>
                        </button>

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
                <!--  -->
            </ul>


        </div>
        <section id="home" ref="home">
            <div
                class="md:flex flex-row min-h-screen bg-gradient-to-r from-sky-500 to-indigo-500 sm:items-center sm:justify-around">
                <div class="md:ms-5 md:px-5 mx-2">
                    <div class="text-3xl text-white leading-10">Join us to engage</div>
                    <div class="text-3xl text-white leading-10">in best seafarership working experience</div>
                    <span class="text-slate-300 leading-10">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Quaerat,
                        veniam.</span>
                </div>
                <div v-if="!$page.props.auth.user" class="bg-white rounded-md shadow-md sm:px-10 sm:py-4">
                    <h1 class="text-xl font-semibold text-center">Register Now!</h1>
                    <Register></Register>
                </div>
                <div v-else>
                    <Link :href="route('seafarer.profile', $page.props.auth.user.id)"
                        class="bg-white rounded-full p-6 hidden md:inline text-lg font-semibold text-black hover:text-#d1e62d dark:text-gray-900 dark:hover:text-gray-600">

                    Go to Profile Dashboard Now!</Link>
                </div>

            </div>

        </section>

        <section id="partners" class="md:mt-10 md:pt-10" style="height: 25%;" ref="partners">
            <h1 class="text-3xl text-center font-light mb-10 mt-14 bg-blue-300 md:bg-transparent">Our Top Life-long
                Partners
            </h1>
            <div class="grid grid-cols-2 gap-x-4 md:grid-cols-5 md:gap-x-12 justify-items-stretch md:mx-32">
                <div class="hover:cursor-pointer px-5 py-8 rounded-lg" v-for="vessel in vessels" :key="vessel.id">
                    <img :src="`/storage/images/${vessel.image}`" class="w-36 h-36 border-2 rounded-md">
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
        <section id="vacancies" class="md:mt-10 md:pt-10" ref="vacancies" style="height: 25%;">
            <h1 class="text-3xl text-blue-600 text-center pt-10 font-semibold mb-10">Offering Now!</h1>
            <div class="grid grid-cols-2 md:grid-cols-4 md:gap-x-20 gap-x-8 justify-items-stretch md:mx-32 mx-12 mb-10">
                <div class="hover:shadow-2xl hover:cursor-pointer rounded-lg" v-for="job in jobs" :key="job.id">
                    <img src="/images/home-seafarer.jpg" class="border-2 rounded-md">
                    <div class="text-lg md:text-center">{{ job.role.name }}</div>
                    <div class="md:text-lg text-sm md:text-center">{{ job.description }}</div>
                    <div class="md:text-lg text-sm md:text-center">{{ job.requirements }}</div>

                </div>

            </div>
            <div class="flex flex-row justify-center">
                <button class="bg-blue-300 w-full md:w-auto px-5 py-3 rounded-full text-lg mb-3"
                    @click="scrollToSection('home')">Apply
                    Now</button>
            </div>

            <div class="mx-auto">

            </div>
        </section>
        <section id="about" ref="about" class="bg-blue-300 md:flex flex-row md:mt-5 items-center" style="height: 25%;">

            <div class="md:w-1/3 text-center leading-loose text-l p-5">
                <div>Lorem ipsum dolor sit amet.</div>
                <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque minus eligendi assumenda, debitis
                    ipsum
                    labore dolor quam! Repellendus.</div>

            </div>
            <div class="md:w-1/3">
                <img :src="image_url">
            </div>

            <div class="md:w-1/3 text-center me-10 pb-6 md:pb-0">
                <div class="text-3xl mt-10">Onboarding more than <span class="text-yellow-400">{{ seafarer_count }}
                    </span>
                </div>
                <div class="text-2xl text-center">Since We Started</div>
            </div>

        </section>
        <BottomNavigationBar></BottomNavigationBar>

    </div>


</template>

<style scoped>
html,
body {
    scroll-behavior: smooth;
}

.mobile-enter-active,
.mobile-leave-active {
    transition: opacity 0.5s ease;
}

.mobile-enter-from,
.mobile-leave-to {
    opacity: 0;
}
</style>
