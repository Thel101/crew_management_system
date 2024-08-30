<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Link } from '@inertiajs/vue3'
const props = defineProps({
    leaves: {
        type: Object
    }
})
</script>
<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Leave Requests</h2>
        </template>
        <div>
            <table v-show="leaves.data.length > 0"
                            class="mx-auto divide-y-2 divide-gray-200 bg-white text-sm">

                            <thead class="ltr:text-left rtl:text-right">
                                <tr>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Seafarer ID</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Seafarer Name</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Vessel</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Leave Start Date</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Leave End Date</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Reason</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Days</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Status</th>


                                    <th class="px-4 py-2"></th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                <tr v-for="leave in leaves.data" :key="leave.id">
                                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ leave.seafarer.formatted_id }}
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ leave.seafarer.fullname}}</td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ leave.seafarer.vessel.name}}</td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ leave.leave_start}}</td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ leave.leave_end}}</td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ leave.reason}}</td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ leave.count}}</td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ leave.status}}</td>

                                    <td class="whitespace-nowrap px-4 py-2">
                                        <Link v-show="leave.status == 'pending'" as="button" method="patch" :href="route('leave.update', leave)"
                                            class="inline-block rounded bg-green-400 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700">
                                            Approve
                                        </Link>

                                    </td>
                                </tr>


                            </tbody>
                        </table>
        </div>
    </AuthenticatedLayout>

</template>
