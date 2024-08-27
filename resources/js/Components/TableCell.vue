<script setup>
const props = defineProps({
    customClass: {
        type: String,
        default: ''
    }
})
</script>

<template>
    <td :class="['border border-slate-700 p-2 rounded-tr-lg rounded-br-lg', customClass]">
        <slot></slot>
    </td>
</template>
