<script setup>
const props = defineProps({
    'leaves': {
        type: Array,
        default: () => [{
            leave_start: '',
            leave_end: '',
            reason: '',
            count: '',
            staff_name: ''
        }]
    }
})
</script>
<template>
    <div>
        <h1 class="text-lg font-bold ml-4">Leaves</h1>
        <table class="divide-y-2 divide-gray-200 bg-white text-sm my-3">
            <thead class="ltr:text-left rtl:text-right">
                <tr>

                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Leave Start Date</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Leave End Date
                    </th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Days Taken</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Reason</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Status</th>

                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"></th>

                    <th class="px-4 py-2"></th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                <tr v-for="leave in props.leaves" :key="leave.id">

                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{
                        leave.leave_start }}
                    </td>
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ leave.leave_end
                        }}</td>
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ leave.count }}
                    </td>
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ leave.reason
                        }}</td>


                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                        <span class="bg-yellow-300 px-2 py-1 rounded-md shadow-sm">{{ leave.status }}</span>
                    </td>
                    <td class="flex flex-row">
                        <!-- <a v-if="leave.status != 'active' && $page.props.auth.user.role == 'admin'" @click.prevent="changeStatus(leave.id)"><svg
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-8 ml-3 mt-1 text-green-500 rounded-full bg-green-300">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </a> -->
                    </td>
                </tr>


            </tbody>
        </table>
    </div>
</template>
