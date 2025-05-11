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
    <div class="flex h-full flex-col justify-between rounded-lg bg-[#ABA5A2] px-4 py-2 text-white hover:cursor-pointer">
        <div class="flex-1 grow">
            <p class="text-md">
                {{ parent }} <span>{{ cat.name }}</span>
            </p>
            <p class="text-md">{{ cat.race }}</p>
            <p class="text-sm">{{ cat.body_color }}</p>
        </div>

        <Button label="voir plus" class="mt-3 self-end text-black" />
    </div>
</template>
