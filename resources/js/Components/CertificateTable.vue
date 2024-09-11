<script setup>
import { router, usePage } from '@inertiajs/vue3';
const props = defineProps({
    'certificates': {
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
        <h1>Certificates</h1>
        <table class="mx-auto divide-y-2 divide-gray-200 bg-white text-sm">
            <thead class="ltr:text-left rtl:text-right">
                <tr>
                    <th></th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Certificate</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Certificate Number
                    </th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Issue Date</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Expiry Date</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Issuing Authority
                    </th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"></th>

                    <th class="px-4 py-2"></th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                <tr v-for=" certificate in props.certificates " :key="certificate.id">
                    <td v-if="certificate.status == 'active'"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="3.5" stroke="currentColor" class="size-5 text-green-500">
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
                    <td class="flex flex-row"><a class="bg-blue-400 rounded-md p-2 mb-3"
                            :href="`/storage/images/${certificate.cert_image}`" target="_blank"
                            rel="noopener noreferrer">View PDF</a>
                        <a v-if="certificate.status != 'active' && $page.props.auth.user.role == 'admin'" @click.prevent="changeStatus(certificate.id)"><svg
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-8 ml-3 mt-1 text-green-500 rounded-full bg-green-300">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </a>
                    </td>
                </tr>


            </tbody>
        </table>
    </div>
</template>
