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

                    <div class="flex justify-center">
                        <table class="table-auto border border-gray-500 w-1/2 bg-slate-300">
                            <thead>
                                <tr>
                                    <th class="border border-slate-700">User Name</th>
                                    <th class="border border-slate-700">Email</th>
                                    <th class="border border-slate-700">Role</th>
                                    <th class="border border-slate-700">Actions</th>
                                </tr>

                            </thead>
                            <tbody>
                                <tr v-for="user in users" :key="user.id">
                                    <TableCell>{{ user.name }}</TableCell>
                                    <TableCell>{{ user.email }}</TableCell>
                                    <TableCell>{{ user.role }}</TableCell>
                                    <TableCell>
                                        <div class="flex flex-row justify-start">
                                            <Link :href="route('user.detail', user.id)"
                                                class="me-2 text-blue-400 font-bold hover:text-blue-700">View
                                            </Link>
                                            <Link href="#" class="me-3 text-red-400 font-bold hover:text-red-700">
                                            Deactivate</Link>

                                        </div>




                                    </TableCell>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>



            </div>
        </div>
    </AuthenticatedLayout>
</template>
