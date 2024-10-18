<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);


</script>

<template>
    <div id="main">
        <div id="wrapper" class="min-h-screen bg-gray-100">
            <nav class="border-b border-gray-400">
                <!-- Primary Navigation Menu -->
                <div>
                    <div class="flex justify-between h-16 bg-blue-400">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('dashboard')">
                                <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800" />
                                </Link>
                                <div class="text-xl ms-2 font-bold">
                                    CMS
                                </div>
                            </div>
                        </div>
                        <!-- Navigation Links -->


                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <!-- Settings Dropdown -->
                            <div class="ms-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                {{ $page.props.auth.user.name }}

                                                <svg class="ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
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
                        </div>
                    </div>
                </div>

            </nav>

            <!-- Page Heading -->


            <!-- Page Content -->
            <div>

                <main class="flex flex-row min-h-screen">
                    <div id="nav" class="flex flex-col bg-gray-300 w-2/12 min-h-screen">
                        <!-- <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </NavLink> -->
                        <NavLink v-show="$page.props.auth.user.role == 'admin'" :href="route('users.index')"
                            :active="route().current('users.index')">
                            Users
                        </NavLink>

                        <NavLink :href="route('applicants.list')" :active="route().current('applicants.list')">
                            Applicants
                            <span class="ms-2 bg-green-500 px-3 rounded-full m-5">{{ $page.props.applied.count
                                }}</span>
                        </NavLink>



                        <NavLink :href="route('seafarer.list')" :active="route().current('seafarer.list')">
                            Seafarers
                        </NavLink>
                        <NavLink :href="route('roles.index')" :active="route().current('roles.index')">
                            Roles
                        </NavLink>
                        <NavLink :href="route('vessels.index')" :active="route().current('vessels.index')">
                            Vessels
                        </NavLink>
                        <NavLink :href="route('jobs.index')" :active="route().current('jobs.index')">
                            Vacancy
                        </NavLink>

                        <NavLink :href="route('leave.index')" :active="route().current('leave.index')">
                            Leave Request
                            <span class="ms-2 bg-green-500 px-3 rounded-full m-5">{{ $page.props.leave.count
                                }}</span>
                        </NavLink>




                    </div>
                    <div class="flex-1 h-full overflow-y-auto">

                        <slot />
                    </div>
                </main>
            </div>

        </div>
    </div>
</template>
<style scoped></style>
