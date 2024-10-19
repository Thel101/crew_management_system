<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
const emit = defineEmits(['showModal'])
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
const form = useForm({
    id: '',
    file: '',
})
const showFile = ref(false)
const showFileForm = (id) => {
    showFile.value = !showFile.value
    form.id = id
}
const changeDocumentFile = (e) => {
    form.file = e.target.files[0]
}
const showModal = ref(false)
const modalTitle = ref('')
const modalMessage = ref('')
const closeModal = () => {
    showModal.value = false
}
const attachFile = () => {
    form.post(route('medicalDocuments.attach'), {
        onSuccess: () => {
            form.reset()
            showFile.value = false
            emit('showModal', true)
        }
    })
}
</script>
<template>

    <table class="w-full divide-y-2 divide-gray-200 bg-white text-sm">
        <thead class="text-left">
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
                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ document.clinic }}</td>
                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ document.document_date }}</td>
                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ document.created_at }}</td>
                <td class="whitespace-nowrap px-4 py-2 text-gray-700"> {{ document.status }}</td>
                <td class="whitespace-nowrap px-4 py-2 text-gray-700 space-x-2">
                    <a class="bg-yellow-300 rounded-md p-2 mb-3" :href="`/storage/documents/${document.file}`"
                        target="_blank" rel="noopener noreferrer">View PDF</a>

                    <a class="ms-2 mt-2" v-if="$page.props.auth.user.role == 'admin'"
                        :href="route('medicalDocuments.show', document)">
                        <span class="bg-blue-400 px-2 py-2 rounded-md hover:cursor-pointer">Edit</span>
                    </a>
                    <button @click="showFileForm(document.id)" class="ms-2 mt-2"
                        v-if="$page.props.auth.user.role == 'admin'">
                        <span class="bg-blue-400 px-2 py-2 rounded-md hover:cursor-pointer">Attach</span>
                    </button>

                </td>
            </tr>


        </tbody>
    </table>
    <div class="my-2" v-show="showFile">
        <input type="file" accept=".pdf" @change="changeDocumentFile">
        <button @click="attachFile" class="bg-blue-400 px-2 py-2 rounded-md hover:cursor-pointer">Attach</button>
    </div>
    <template>
        <Modal :show="showModal" :closeable="true" class="max-w-md" @close="closeModal">
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
