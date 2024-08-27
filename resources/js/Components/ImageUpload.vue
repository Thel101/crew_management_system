<script setup>
import { ref, defineEmits } from 'vue';

const src = ref('')
const emits = defineEmits(['file-selected']);
const change = (e) => {
    const file = e.target.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = (event) => {
            src.value = event.target.result
            emits(['file-selected', { src: src.value, file }]);
        }
        reader.readAsDataURL(file);
    }
    // src.value = e.target.files[0];
}
</script>

<template>
    <div>
        <img v-if="src" :src="src" alt="Profile Image" class="mb-2">
        <input type="file" name="" id="" @change="change" ref="file">

    </div>

</template>
