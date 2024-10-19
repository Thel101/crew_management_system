<script setup>
import { router, usePage } from '@inertiajs/vue3';
const props = defineProps({
    seafarer: {
        type: Boolean
    },
    certificates: {
        type: Array,
        default: () => [{
            id: '',
            name: '',
            status: '',
            certificate_no: '',
            issue_date: '',
            expiry_date: '',
            authority: '',
            cert_image: ''
        }]
    }

})
const changeStatus = (id) => {
    router.patch(route('certificate.status', id))
}

</script>
<template>
    <div>

        <table class="w-full divide-y-2 divide-gray-200 bg-white text-sm my-3">
            <thead class="text-center bg-slate-600">
                <tr class="text-white">
                    <th class="whitespace-nowrap px-4 py-2 font-medium rounded-tl-lg">
                    </th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium">Certificate</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium">Certificate Number
                    </th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium">Issue Date</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium">Expiry Date</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium">Issuing Authority
                    </th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"></th>

                    <th v-show="props.seafarer" class="whitespace-nowrap px-4 py-2 font-medium">
                    </th>
                </tr>
            </thead>

            <tbody class="w-full divide-y divide-gray-200 text-center">
                <tr class="w-full" v-for=" certificate in props.certificates " :key="certificate.id">
                    <td class="whitespace-nowrap px-4 py-2 font-medium" v-if="certificate.status == 'active'"><svg
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3.5"
                            stroke="currentColor" class="size-5 text-green-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </td>
                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{
                        certificate.name }}
                    </td>
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ certificate.certificate_no
                        }}</td>
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ certificate.issue_date }}
                    </td>
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ certificate.expiry_date
                        }}</td>


                    <td class="whitespace-nowrap px-4 py-2 text-gray-700"> {{
                        certificate.issuing_authority }}

                    </td>
                    <td class="whitespace-nowrap px-4 py-2 text-gray-700 space-x-2"><a
                            class="bg-yellow-300 rounded-md p-2 mb-3"
                            :href="`/storage/images/${certificate.cert_image}`" target="_blank"
                            rel="noopener noreferrer">View PDF</a>
                        <a class="ms-2 mt-2"
                            v-if="certificate.status != 'active' && $page.props.auth.user.role == 'admin'"
                            @click.prevent="changeStatus(certificate.id)">
                            <span class="bg-green-300 px-2 py-2 rounded-md hover:cursor-pointer">Approve </span>
                        </a>
                        <a v-show="props.seafarer" class="ms-2 mt-2" v-if="$page.props.auth.user.role == 'admin'"
                            :href="route('certificates.show', certificate)">
                            <span class="bg-blue-400 px-2 py-2 rounded-md hover:cursor-pointer">Edit</span>
                        </a>
                    </td>
                </tr>


            </tbody>
        </table>
    </div>
</template>
