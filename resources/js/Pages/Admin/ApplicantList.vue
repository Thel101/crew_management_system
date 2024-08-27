<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
<<<<<<< HEAD
import { ref, watch } from 'vue'
=======
import { computed, ref, watch } from 'vue'
>>>>>>> master
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Dropdown from '@/Components/Dropdown.vue';
<<<<<<< HEAD
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
import { XMarkIcon } from '@heroicons/vue/24/outline'
import { ChevronDownIcon, FunnelIcon, MinusIcon, PlusIcon, Squares2X2Icon } from '@heroicons/vue/20/solid'
import { Inertia } from '@inertiajs/inertia';
=======
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
import { XMarkIcon } from '@heroicons/vue/24/outline'
import { ChevronDownIcon, FunnelIcon, MinusIcon, PlusIcon, Squares2X2Icon } from '@heroicons/vue/20/solid'

>>>>>>> master


const props = defineProps({
    applicants:
    {
        type: Object
    },
    jobs:{
        type: Array
    }
})
<<<<<<< HEAD
const sortOptions = props.roles
=======
// const sortOptions = props.jobs.role
>>>>>>> master

const sorting = ref(false);

const form = useForm({
    user_id :  '',
    role_id : '',
    vessel_id: ''
});

const showAssignForm = ref(false)
const seafarer_name = ref('');
const seaman_book = ref('');
const seafarer_role = ref('');
const role_id = ref(0)
const seafarer_id = ref('');
<<<<<<< HEAD

=======
const email_id = ref('');
const search = ref(''), pageNumber = ref(0)

let applicantUrl = computed(()=>{
    let url = new URL(route("applicants.list"))
    url.searchParams.append("pageNumber", pageNumber.value)
    if(search.value){
        url.searchParams.append("search", search.value)
    }
    return url;
});

watch( applicantUrl , newUrl=>{
    router.visit(newUrl,{
        preserveState : true,
        preserveScroll: true,
        replace: true
    })
})
>>>>>>> master
const AssignSeafarer = (id,name, book, role_name, roleId)=>{
   showAssignForm.value = true;
   seafarer_id.value = id;
   seafarer_name. value = name;
   seaman_book.value = book;
   seafarer_role.value = role_name;
   role_id.value = roleId;
<<<<<<< HEAD

   form.user_id = id;
   form.role_id = roleId;

   watch(role_id, value =>{
    Inertia.get('/applicants', {role_id: value },
    {
        preserveState : true
    });
})

}
=======
   email_id.value = id;
   form.user_id = id;
   form.role_id = roleId;
}

watch(role_id, value =>{
    Inertia.get('/applicants', {role_id: value });
});

// watch(search, value =>{
//    router.visit(route('applicants.list', {search : value}))
// })


>>>>>>> master
const selectedVessel = ref('');
const selectVessel = (vessel_id, vessel_name) => {
    selectedVessel.value = vessel_name;
    form.vessel_id = vessel_id
}

const assign = ()=>{
    form.patch(route('applicant.status'),{
        onSuccess:()=>{
            form.reset();
            showAssignForm.value = false
<<<<<<< HEAD
=======
            Inertia.get(route('assign.email', email_id))
>>>>>>> master
        }
    })
}

</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">applicants</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden">
<<<<<<< HEAD
                    <div v-show="applicants.data.length < 0" class="text-center text-red-400 font-bold text-2xl">There is no applicants!</div>

                    <div v-show="applicants.data.length > 0" class="overflow-x-auto">
=======
                    <div v-show="props.applicants.data.length < 0" class="text-center text-red-400 font-bold text-2xl">There is no applicants!</div>

                    <div v-show="props.applicants.data.length > 0" class="overflow-x-auto">
>>>>>>> master

                        <div class="flex flex-row justify-end me-14 mb-10">
                        <Menu as="div" class="inline-block text-left">
                            <div>
                                <MenuButton @click="sorting =!sorting" class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900">
                                Sort
                                <ChevronDownIcon class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500" aria-hidden="true" />
                                </MenuButton>
                            </div>

                            <transition v-show="sorting" enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                                <MenuItems class="absolute right-40 z-10 mt-2 w-40 origin-top-right rounded-md bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <div class="py-1">
                                    <MenuItem v-for="option in sortOptions" :key="option.role.id" v-slot="{ active }">
                                    <a :href="option.href" :class="[option.current ? 'font-medium text-gray-900' : 'text-gray-500', active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm']">{{ option.role.name }}</a>
                                    </MenuItem>
                                </div>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </div>
<<<<<<< HEAD

=======
                        <input type="text" v-model="search" placeholder="Search...">
>>>>>>> master
                        <table class="mx-auto divide-y-2 divide-gray-200 bg-white text-sm">
                            <thead class="ltr:text-left rtl:text-right">
                                <tr>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Name</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">ApplicantID</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Seaman Book</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Nationality</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Phone Number</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Email</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Role</th>
<<<<<<< HEAD
                                    <th class="px-4 py-2"></th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                <tr v-for="applicant in applicants.data" :key="applicant.id">
=======
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Applied Date</th>
                                    <th class="px-4 py-2"></th>
                                </tr>
                            </thead>
                            <!-- {{ search }} {{ pageNumber }} -->
                            <tbody class="divide-y divide-gray-200">
                                <tr v-for="applicant in props.applicants.data" :key="applicant.id">
>>>>>>> master

                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ applicant.fullname }}</td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ applicant.formatted_id }}
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ applicant.seaman_book}}</td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ applicant.nationality}}</td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ applicant.mobile_no}}</td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ applicant.email}}</td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ applicant.role.name}}</td>
<<<<<<< HEAD
=======
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ new Date(applicant.created_at).toLocaleDateString('en-US')}}</td>

>>>>>>> master

                                    <td class="whitespace-nowrap px-4 py-2">
                                        <a :href="route('applicant.detail', applicant.id)"
                                            class="mx-2 inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700">
                                            View
                                        </a>
                                        <Link preserve-state @click="AssignSeafarer(applicant.id, applicant.fullname, applicant.seaman_book, applicant.role.name, applicant.role.id)" href="#"
                                            class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700">
                                            Assign
                                        </Link>
                                    </td>
                                </tr>


                            </tbody>
                        </table>
                        <div class="flex justify-end lg:me-24" v-if="applicants.links.length > 0">
                            <ul class="flex">
                                <li class="mr-2" v-for="link in applicants.links" :key="link.label">
                                    <a :href="link.url" v-html="link.label"></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>


            </div>

                <div v-show="showAssignForm">
                    <div class="max-w-lg mx-auto justify-center">
                    <h1></h1>
                <form @submit.prevent="assign">
                    <div class="flex flex-row justify-center gap-2">
                        <div>
                            <InputLabel>Applicant Name</InputLabel>
                            <TextInput v-model="seafarer_name" placeholder="Applicant Name"></TextInput>
                        </div>
                        <div>
                            <InputLabel>Seaman Book Number</InputLabel>
                            <TextInput v-model="seaman_book" placeholder="Applicant Name"></TextInput>
                        </div>
                    </div>
                    <div class="flex flex-row justify-center gap-2">
                        <div>
                            <InputLabel>Role</InputLabel>
                            <TextInput aria-placeholder="Role" v-model="seafarer_role"></TextInput>
                        </div>
                        <div>
                            <InputLabel>Vessel</InputLabel>
                            <Dropdown align="left" width="48" contentClasses="py-2 bg-gray-100">
                                    <template #trigger>
                                        <div
                                            class="mt-1 px-4 py-2 rounded-md border-2 bg-white text-gray-600 block w-full">
                                             {{selectedVessel || 'Select Vessel'}}</div>

                                    </template>
                                    <template #content>
                                        <ul>
                                            <li v-for="job in jobs" :key="job.id"
                                            @click="selectVessel(job.vessel.id, job.vessel.name)"
                                            class="cursor-pointer hover:bg-gray-200"> {{ job.vessel.name }}</li>
                                        </ul>
                                    </template>
                                </Dropdown>


                        </div>
                    </div>
                    <div class="flex flex-row justify-center">
                        <PrimaryButton>Assign Seafarer</PrimaryButton>
                    </div>

                </form>
            </div>
                </div>
        </div>
    </AuthenticatedLayout>
</template>
