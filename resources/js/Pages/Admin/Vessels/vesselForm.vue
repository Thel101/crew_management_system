<script setup>
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const page = usePage();
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
    'image',
    'edit',
    'vessel'

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
    image: props.image

});
const showModal = ref(false);
const closeModal = () => {
    showModal.value = false
}
const src = ref('');

const change = (e) => {
    const file = e.target.files[0];
    form.image = file;

    const reader = new FileReader();
    reader.onload = (event) => {
        src.value = event.target.result;
    };

    if (file) {
        reader.readAsDataURL(file);
    }
};
const showImageChange = ref(false);
const modalTitle = ref('');
const modalMessage = ref('');



const submit = () => {
    if (props.edit == true) {
        form.patch(route('vessels.update', props.vessel),
            {
                onSuccess: (page) => {
                    showModal.value = true
                    modalTitle.value = 'Vessel Edit Successful'
                    modalMessage.value = page.props.flash.message
                    Inertia.visit(route('vessel.show', [props.vessel]));

                }
            })
    }
    else {
        form.post(route('vessels.store'), {
            onSuccess: (page) => {
                src.value = ''
                form.reset()
                showModal.value = true
                modalTitle.value = 'Vessel Creation Successful'
                modalMessage.value = page.props.flash.message
            }
        });
    }

};
const vesselImageForm = useForm({
    vessel_id: props.edit == true ? props.vessel.id || null : null,
    image: null
});
const update = (e) => {
    const file = e.target.files[0];
    vesselImageForm.image = file;
};

const updateImage = () => {
    vesselImageForm.post(route('vessel.updateImage'), {
        onSuccess: (page) => {
            showModal.value = true
            modalTitle.value = 'Image Update Successful'
            modalMessage.value = page.props.flash.message
            Inertia.reload()
            showImageChange.value = false
        }
    });
}
</script>

<template>
    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-md border-gray-400 mt-4 p-3">
        <h1 v-if="props.edit = true" class="text-center text-xl font-semibold mb-5 mt-3">Vessel Information</h1>
        <h1 v-else class="text-center text-xl font-semibold mb-5 mt-3">Create New Vessel</h1>
        <PrimaryButton @click="showImageChange = !showImageChange" class="my-2">Change Image</PrimaryButton>
        <div class="flex flex-row" v-show="showImageChange">
            <button @click="updateImage" class="my-2 mr-2 rounded-md bg-black text-white px-2"><svg
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                </svg>
            </button>
            <input class="my-2" accept=".jpg,.jpeg,.png,.webp" @change="update" type="file">

        </div>

        <form @submit.prevent="submit">
            <div>

                <img v-if="props.image" :src="`/storage/images/${props.image}`" class="w-36 h-36 rounded-md"
                    :alt="form.image" />
                <img class="w-36 h-36 rounded-md" v-show="src" :src="src" :alt="src">
                <input v-show="props.edit == false" accept=".jpg,.jpeg,.png,.webp" type="file" @change="change">



            </div>


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
