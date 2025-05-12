<script lang="ts" setup>
import { Cat } from '@/types';
import Button from './Button.vue';

defineProps<{
    cat: Cat;
    parent: string;
    index: number;
}>();
</script>
<template>
    <div class="flex h-full flex-col justify-between rounded-lg bg-[#ABA5A2] p-2 py-2 text-white hover:cursor-pointer md:px-4">
        <div class="flex-1 grow">
            <p class="text-md">
                {{ parent }} <span>{{ cat.name }}</span>
            </p>
            <p class="text-md">{{ cat.race }}</p>
            <p class="text-sm">{{ cat.body_color }}</p>
        </div>

        <Button label="voir plus" class="mt-3 justify-center text-black md:self-end" />
    </div>
</template>
