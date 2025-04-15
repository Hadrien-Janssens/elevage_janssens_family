<script lang="ts" setup>
import { ArrowUpRight } from 'lucide-vue-next';

const props = defineProps({
    label: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <button class="flex items-center justify-between gap-3 rounded-2xl bg-white p-1 pl-4" @click="$emit('click')">
        {{ label }}
        <div class="bg-primary rounded-full text-white">
            <ArrowUpRight />
        </div>
    </button>
</template>
