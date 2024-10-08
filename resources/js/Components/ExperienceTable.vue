<script setup>
const props = defineProps({
    experiences: {
        type: Array,
        default: () => [{
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
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm my-2">
        <thead class="text-center bg-slate-600">
            <tr class="text-white">
                <th class="whitespace-nowrap py-2 font-medium rounded-tl-lg">Ship Name</th>
                <th class="whitespace-nowrap py-2 font-medium">Flag</th>
                <th class="whitespace-nowrap py-2 font-medium">Ship Type</th>
                <th class="whitespace-nowrap py-2 font-medium">Rank</th>
                <th class="whitespace-nowrap py-2 font-medium">GRT
                </th>
                <th class="whitespace-nowrap py-2 font-medium">Trade</th>
                <th class="whitespace-nowrap py-2 font-medium">Sign-on</th>
                <th class="whitespace-nowrap py-2 font-medium rounded-tr-lg">Sign-off</th>
            </tr>
        </thead>

        <tbody class="w-full text-center divide-y divide-gray-200">
            <tr v-for=" experience in props.experiences " :key="experience.id">
                <td class="whitespace-nowrap py-2 font-medium text-gray-900">{{
                    experience.ship_name }}
                </td>
                <td class="whitespace-nowrap py-2 text-gray-700">{{ experience.flag
                    }}</td>
                <td class="whitespace-nowrap py-2 text-gray-700">{{ experience.ship_type }}
                </td>
                <td class="whitespace-nowrap py-2 text-gray-700">{{ experience.rank
                    }}</td>


                <td class="whitespace-nowrap py-2 text-gray-700"> {{ experience.GRT }}

                </td>
                <td class="whitespace-nowrap py-2 text-gray-700"> {{ experience.trade }}

                </td>
                <td class="whitespace-nowrap py-2 text-gray-700"> {{ experience.sign_on_date }}

                </td>
                <td class="whitespace-nowrap py-2 text-gray-700"> {{ experience.sign_off_date
                    }}

                </td>
            </tr>


        </tbody>
    </table>
    </div>

</template>
