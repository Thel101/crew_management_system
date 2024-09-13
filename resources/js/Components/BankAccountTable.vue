<script setup>
const props = defineProps({
    bank_accounts: {
        type: Array,
        default: () => [{
            id: '',
            account_no: '',
            bank_branch: '',
            account_holder: '',
            holder_phone: '',

        }]
    }
})
</script>
<template>

    <table class="table-auto w-full divide-y-2 divide-gray-200 bg-white text-sm shadow-lg my-2 border-gray-400">
        <thead class="w-full text-white text-center bg-slate-600">
            <tr>
                <th class="whitespace-nowrap px-4 py-2 font-medium rounded-tl-lg">Bank Account</th>
                <th class="whitespace-nowrap px-4 py-2 font-medium">Bank Branch</th>
                <th class="whitespace-nowrap px-4 py-2 font-medium">Account Holder</th>
                <th class="whitespace-nowrap px-4 py-2 font-medium rounded-tr-lg">Holder Phone</th>
                <th></th>

            </tr>
        </thead>

        <tbody class="w-full text-center divide-y divide-gray-200">
            <tr class="hover:bg-gray-300" v-for="bank_account in props.bank_accounts " :key="bank_account.id">
                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{
                    bank_account.account_no }}
                </td>
                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ bank_account.bank_branch}}</td>
                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ bank_account.account_holder }}</td>
                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ bank_account.holder_phone}}</td>

            </tr>


        </tbody>
    </table>
</template>
