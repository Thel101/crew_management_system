<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'items-center px-3 py-3 border-b-2 border-indigo-400 text-lg font-medium leading-5 text-black bg-blue shadow-md focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out bg-blue-400'
        : 'items-center px-3 py-3 border-b-2 border-slate-300 text-lg font-medium leading-5 text-black hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
