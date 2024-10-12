<script setup>
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import { ref } from 'vue';
const props = defineProps([
    'name',
    'flag',
    'type',
    'IMO_number',
    'built',
    'GRT',
    'DWT',
    'Engine',
    'BHP',
    'trade',
    'edit',
    'vessel',
    'image'

])

const form = useForm({
    name: props.name,
    flag: props.flag,
    type: props.type,
    IMO_number: props.IMO_number,
    built: props.built,
    GRT: props.GRT,
    DWT: props.DWT,
    Engine: props.Engine,
    BHP: props.BHP,
    Trade: props.trade,
    image: ''

});
const showModal = ref(false);
const closeModal = () => {
    showModal.value = false
}
const src = ref('');


const modalMessage = ref('');
const modalTitle = ref('');
const submit = () => {
    if (props.edit == true) {
        console.log(form)
        form.patch(route('vessels.update', props.vessel),
            {
                onSuccess: () => {
                    showModal.value = true
                    modalTitle.value = 'Vessel Edit Successful'
                    modalMessage.value = 'Vessel information has been updated successfully!'
                }
            })
    }
    else {
        form.post(route('vessels.store'), {
            onSuccess: () => form.reset()
        });
    }

};
</script>
<template>
    <div class="max-w-2xl mx-auto bg-slate-200 rounded-md p-3 mb-5">
        <h1 v-if="props.edit =true" class="text-center text-xl font-semibold mb-5 mt-3">Vessel Information</h1>
        <h1 v-else class="text-center text-xl font-semibold mb-5 mt-3">Create New Vessel</h1>
        <form @submit.prevent="submit">
            <img v-if="props.vessel.image != null" :src="`/storage/images/${props.vessel.image}`"
                    class="w-36 h-36 rounded-md" :alt="props.vessel.image" />
                <img v-else src="/images/logo1.jpeg" class="w-36 h-36 rounded-md" alt="vessel-image" />
            <div class="flex flex-row justify-between">
                <div class="mr-5">
                    <InputLabel for="name" value="Vessel Name" />

                    <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="mr-5">
                    <InputLabel for="flag" value="Vessel Flag" />

                    <TextInput id="flag" type="text" class="mt-1 block w-full" v-model="form.flag" />

                    <InputError class="mt-2" :message="form.errors.flag" />
                </div>
                <div>
                    <InputLabel for="type" value="Vessel Type" />

                    <TextInput id="type" type="text" class="mt-1 block w-full" v-model="form.type" />

                    <InputError class="mt-2" :message="form.errors.type" />
                </div>
            </div>
            <div class="flex flex-row justify-between mt-4">

                <div>
                    <InputLabel for="IMO_num" value="IMO Number" />

                    <TextInput id="IMO_num" type="text" class="mt-1 block w-full" v-model="form.IMO_number" />

                    <InputError class="mt-2" :message="form.errors.IMO_number" />
                </div>
                <div>
                    <InputLabel for="built" value="Vessel Built Year" />

                    <TextInput id="built" type="text" class="mt-1 block w-full" v-model="form.built" />

                    <InputError class="mt-2" :message="form.errors.built" />
                </div>

                <div>
                    <InputLabel for="grt" value="GRT" />

                    <TextInput id="grt" type="text" class="mt-1 block w-full" v-model="form.GRT" />

                    <InputError class="mt-2" :message="form.errors.GRT" />
                </div>
            </div>

            <div class="flex flex-row justify-between mt-4">
                <div class="mr-3">
                    <InputLabel for="dwt" value="Vessel DWT" />

                    <TextInput id="dwt" type="text" class="mt-1 block w-full" v-model="form.DWT" />

                    <InputError class="mt-2" :message="form.errors.DWT" />
                </div>

                <div class="mr-3">
                    <InputLabel for="engine" value="Engine Make" />

                    <TextInput id="engine" type="text" class="mt-1 block w-full" v-model="form.Engine" />

                    <InputError class="mt-2" :message="form.errors.Engine" />
                </div>
                <div class="mr-3">
                    <InputLabel for="bhp" value="Vessel BHP" />

                    <TextInput id="bhp" type="text" class="mt-1 block w-full" v-model="form.BHP" />

                    <InputError class="mt-2" :message="form.errors.BHP" />
                </div>
                <div>
                    <InputLabel for="trade" value="Trade" />

                    <TextInput id="trade" type="text" class="mt-1 block w-full" v-model="form.Trade" />

                    <InputError class="mt-2" :message="form.errors.Trade" />
                </div>
            </div>

            <div v-if="props.edit == true" class="flex justify-center mt-5">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Edit Vessel
                </PrimaryButton>
            </div>

            <div v-else class="flex justify-center mt-5">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Create New Vessel
                </PrimaryButton>
            </div>


        </form>

    </div>
    <template>
        <Modal :show="showModal" :closeable="true" @close="closeModal">
            <div class="p-4 bg-green-200">
                <h2 class="text-lg font-bold">{{ modalTitle }}</h2>
                <p>{{ modalMessage }}</p>
                <div class="flex flex-row justify-end">
                    <button @click="closeModal"
                        class="bg-gray-300 rounded-md border-2 border-slate-300 px-3 py-2 mt-4">Close</button>
                </div>
            </div>
        </Modal>
    </template>
</template>
