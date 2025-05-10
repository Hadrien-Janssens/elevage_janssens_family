<script lang="ts" setup>
defineProps<{
    name: string;
    parent: string;
    index: number;
}>();
</script>
<template>
    <div class="rounded-lg bg-gray-100 px-4 py-2 hover:cursor-pointer" :class="[{ 'bg-white': index % 2 === 1 }]">
        <p class="text-sm text-gray-500">{{ parent }}</p>
        <p class="font-medium">{{ name }}</p>
    </div>
</template>
