<script setup>
const props = defineProps({
    label: {
        type: String
    },
    text:{
        type: String
    }
})
</script>
<template>
    <div>
        <span class="text-lg font-bold">{{ label }} : </span> <span>{{ text }}</span>
    </div>
</template>
