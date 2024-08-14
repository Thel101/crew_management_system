<script setup>
import TableCellVue from '@/Components/TableCell.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import TableCell from '@/Components/TableCell.vue';
const props = defineProps({
    users:
    {
        type: Array
    }
})

</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="overflow-x-auto">
                        <table class="mx-auto divide-y-2 divide-gray-200 bg-white text-sm">
                            <thead class="ltr:text-left rtl:text-right">
                                <tr>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Name</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Email</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Role</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Applied Date</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"></th>

                                    <th class="px-4 py-2"></th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                <tr v-for="user in users.data" :key="user.id">
                                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{
                                    user.name }}
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ user.email }}</td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ user.role }}
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ new
                                    Date(user.created_at).toDateString()
                                        }}</td>


                                    <td class="whitespace-nowrap px-4 py-2">
                                        <a :href="route('user.detail', user.id)"
                                            class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700">
                                            View
                                        </a>
                                    </td>
                                </tr>


                            </tbody>
                        </table>
                        <div class="flex justify-end lg:me-24" v-if="users.links.length > 0">
                            <ul class="flex">
                                <li class="mr-2" v-for="link in users.links" :key="link.label">
                                    <a :href="link.url" v-html="link.label"></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>



            </div>
        </div>
    </AuthenticatedLayout>
</template>
