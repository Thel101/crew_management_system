<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TableCell from '@/Components/TableCell.vue';
defineProps({
    vessels:
    {
        type: Array
    }
})
const form = useForm({
    name: '',
    flag: '',
    type: '',
    IMO_number: '',
    built: '',
    GRT: '',
    DWT: '',
    Engine: '',
    BHP: '',
    Trade: ''

});

const submit = () => {
    form.post(route('vessels.store'), {
        onSuccess: () => form.reset()
    });
};

</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Roles</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="max-w-lg mx-auto">
                        <form @submit.prevent="submit">
                            <div class="flex flex-row justify-between">
                                <div>
                                    <InputLabel for="name" value="Vessel Name" />

                                    <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name"
                                        autofocus />

                                    <InputError class="mt-2" :message="form.errors.name" />
                                </div>

                                <div>
                                    <InputLabel for="flag" value="Vessel Flag" />

                                    <TextInput id="flag" type="text" class="mt-1 block w-full" v-model="form.flag" />

                                    <InputError class="mt-2" :message="form.errors.flag" />
                                </div>
                            </div>
                            <div class="flex flex-row justify-between mt-4">
                                <div>
                                    <InputLabel for="type" value="Vessel Type" />

                                    <TextInput id="type" type="text" class="mt-1 block w-full" v-model="form.type"
                                        autofocus />

                                    <InputError class="mt-2" :message="form.errors.type" />
                                </div>

                                <div>
                                    <InputLabel for="IMO_num" value="IMO Number" />

                                    <TextInput id="IMO_num" type="text" class="mt-1 block w-full"
                                        v-model="form.IMO_number" />

                                    <InputError class="mt-2" :message="form.errors.IMO_number" />
                                </div>
                            </div>
                            <div class="flex flex-row justify-between mt-4">
                                <div>
                                    <InputLabel for="built" value="Vessel Built Year" />

                                    <TextInput id="built" type="text" class="mt-1 block w-full" v-model="form.built"
                                        autofocus />

                                    <InputError class="mt-2" :message="form.errors.built" />
                                </div>

                                <div>
                                    <InputLabel for="grt" value="GRT" />

                                    <TextInput id="grt" type="text" class="mt-1 block w-full" v-model="form.GRT" />

                                    <InputError class="mt-2" :message="form.errors.GRT" />
                                </div>
                            </div>
                            <div class="flex flex-row justify-between mt-4">
                                <div>
                                    <InputLabel for="dwt" value="Vessel DWT" />

                                    <TextInput id="dwt" type="text" class="mt-1 block w-full" v-model="form.DWT"
                                        autofocus />

                                    <InputError class="mt-2" :message="form.errors.DWT" />
                                </div>

                                <div>
                                    <InputLabel for="engine" value="Engine Make" />

                                    <TextInput id="engine" type="text" class="mt-1 block w-full"
                                        v-model="form.Engine" />

                                    <InputError class="mt-2" :message="form.errors.Engine" />
                                </div>
                            </div>
                            <div class="flex flex-row justify-between mt-4">
                                <div>
                                    <InputLabel for="bhp" value="Vessel BHP" />

                                    <TextInput id="bhp" type="text" class="mt-1 block w-full" v-model="form.BHP"
                                        autofocus />

                                    <InputError class="mt-2" :message="form.errors.BHP" />
                                </div>

                                <div>
                                    <InputLabel for="trade" value="Trade" />

                                    <TextInput id="trade" type="text" class="mt-1 block w-full" v-model="form.Trade" />

                                    <InputError class="mt-2" :message="form.errors.Trade" />
                                </div>
                            </div>

                            <div class="flex justify-center">
                                <PrimaryButton class="my-5" :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing">
                                    Create New Role
                                </PrimaryButton>
                            </div>


                        </form>
                        <h1 class="text-xl font-bold text-center">Roles</h1>
                    </div>

                    <div class="flex justify-center">
                        <table class="table-auto border border-gray-500 w-1/2 bg-slate-300">
                            <thead>
                                <tr>
                                    <th class="border border-slate-700">Name</th>
                                    <th class="border border-slate-700">Flag</th>
                                    <th class="border border-slate-700">Type</th>
                                    <th class="border border-slate-700">IMO_Number</th>
                                    <th class="border border-slate-700">Built</th>
                                    <th class="border border-slate-700">GRT</th>
                                    <th class="border border-slate-700">DWT</th>
                                    <th class="border border-slate-700">Engine</th>
                                    <th class="border border-slate-700">Trade</th>
                                    <th class="border border-slate-700">Actions</th>
                                </tr>

                            </thead>
                            <tbody>
                                <tr v-for="vessel in vessels" :key="vessel.id">
                                    <TableCell>{{ vessel.name }}</TableCell>
                                    <TableCell>{{ vessel.flag }}</TableCell>
                                    <TableCell>{{ vessel.type }}</TableCell>
                                    <TableCell>{{ vessel.IMO_number }}</TableCell>
                                    <TableCell>{{ vessel.built }}</TableCell>
                                    <TableCell>{{ vessel.GRT }}</TableCell>
                                    <TableCell>{{ vessel.DWT }}</TableCell>
                                    <TableCell>{{ vessel.Engine }}</TableCell>
                                    <TableCell>{{ vessel.BHP }}</TableCell>
                                    <TableCell>{{ vessel.Trade }}</TableCell>

                                    <TableCell>
                                        <div class="flex flex-row justify-start">
                                            <Link href="#" class="me-2 text-blue-400 font-bold hover:text-blue-700">View
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
