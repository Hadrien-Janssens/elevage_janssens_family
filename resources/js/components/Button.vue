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
    <button
        class="group flex items-center justify-between gap-3 rounded-2xl border-2 border-[#B38D7D] bg-white p-1 pl-4 font-black hover:cursor-pointer"
        @click="$emit('click')"
    >
        {{ label }}
        <div class="rounded-full bg-[#B38D7D] text-white transition-transform duration-500 ease-in-out group-hover:scale-110 group-hover:rotate-405">
            <ArrowUpRight />
        </div>
    </button>
</template>
