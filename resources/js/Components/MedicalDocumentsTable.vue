<script setup>
const props = defineProps({
    documents: {
        type: Array,
        default: () => [{
            id: '',
            type: '',
            clinic: '',
            document_date: '',
            status: '',
            created_at: '',
        }]
    }
})
</script>
<template>

    <table class="mx-auto divide-y-2 divide-gray-200 bg-white text-sm">
        <thead class="ltr:text-left rtl:text-right">
            <tr>
                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Document Type</th>
                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Issuing Clinic</th>
                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Document Date</th>
                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Uploaded Date</th>
                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Status</th>
                <th></th>

            </tr>
        </thead>

        <tbody class="divide-y divide-gray-200">
            <tr v-for="document in props.documents " :key="document.id">
                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{
                    document.type }}
                </td>
                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ document.clinic}}</td>
                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ document.document_date }}</td>
                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ document.created_at}}</td>
                <td class="whitespace-nowrap px-4 py-2 text-gray-700"> {{ document.status }}</td>

            </tr>


        </tbody>
    </table>
</template>
