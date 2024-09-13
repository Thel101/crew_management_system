<script setup>

const props = defineProps({
    'payrolls': {
        type: Array,
        default: () => [{
            id: '',
            base_salary: '',
            bonus: '',
            overtime_pay: '',
            deduction: '',
            total_salary: '',
            start_date: '',
            end_date: '',
            payment_date: '',
            status: ''
        }]
    }

})

</script>
<template>
    <div>

        <table class="mx-auto divide-y-2 divide-gray-200 bg-white text-sm">
            <thead class="ltr:text-left rtl:text-right">
                <tr>

                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Basis Salary</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Bonus</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Overtime Pay</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Deduction</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Total Salary</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Start date</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">End date</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Payroll date</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Payroll Status</th>

                    <th class="px-4 py-2"></th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                <tr v-for="payroll in props.payrolls " :key="payroll.id">

                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{
                        payroll.base_salary }}
                    </td>
                    <td class="whitespace-nowrap px-4 py-2 text-green-500">{{ payroll.bonus
                        }}</td>
                    <td class="whitespace-nowrap px-4 py-2 text-green-500">{{ payroll.overtime_pay }}
                    </td>
                    <td class="whitespace-nowrap px-4 py-2 text-red-700">{{ payroll.deduction }}</td>

                    <td class="whitespace-nowrap px-4 py-2 font-bold text-blue-700"> {{ payroll.total_salary }}</td>
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700"> {{ payroll.start_date }}</td>
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700"> {{ payroll.end_date }}</td>
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700"> {{ payroll.payment_date }}</td>
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700 ">
                        <span v-if="payroll.status == 0"
                            class="bg-yellow-300 rounded-md px-2 py-1">pending</span>
                            <span v-if="payroll.status == 1"
                            class="bg-green-300 rounded-md px-2 py-1">paid</span>
                        </td>
                    <td v-if="payroll.status == 0 && $page.props.auth.user.role == 'admin'" class="whitespace-nowrap px-4 py-2 text-gray-700">
                        <a :href="route('payroll.pay', payroll.id)"
                            class="bg-blue-400 py-1 px-3 font-bold rounded-md shadow-sm text-white"><button>Pay</button>
                        </a>

                    </td>
                </tr>


            </tbody>
        </table>
    </div>
</template>
