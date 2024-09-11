<script setup>
const props = defineProps({
    experiences: {
        type: Array,
        default :() => [{
            id: '',
            ship_name: '',
            flag: '',
            ship_type: '',
            rank: '',
            GRT: '',
            trade: '',
            sign_on_date: '',
            sign_off_date: ''

        }]
    }
})
</script>
<template>
<h1>Experiences</h1>
                        <table class="mx-auto divide-y-2 divide-gray-200 bg-white text-sm">
                            <thead class="ltr:text-left rtl:text-right">
                                <tr>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Ship Name</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Flag</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Ship Type</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Rank</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">GRT
                                    </th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Trade</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Sign-on</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Sign-off</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                <tr v-for=" experience in props.experiences " :key="experience.id">
                                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{
                                        experience.ship_name }}
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ experience.flag
                                        }}</td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ experience.ship_type }}
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ experience.rank
                                        }}</td>


                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700"> {{ experience.GRT }}

                                    </td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700"> {{ experience.trade }}

                                    </td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700"> {{ experience.sign_on_date }}

                                    </td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700"> {{ experience.sign_off_date
                                        }}

                                    </td>
                                </tr>


                            </tbody>
                        </table>
</template>
