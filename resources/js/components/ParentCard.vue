<script lang="ts" setup>
import { isKitten } from '@/lib/utils';
import { Cat, Kitten } from '@/types';
import { Link } from '@inertiajs/vue3';
import Button from './Button.vue';

defineProps<{
    cat: Cat | Kitten;
    parent: string;
    index: number;
}>();
</script>
<template>
    <div class="flex flex-col rounded-lg bg-[#ABA5A2] p-2 py-2 text-white md:px-4">
        <div class="grow">
            <p class="text-md">
                {{ parent }} <span>{{ cat.name }}</span>
            </p>
            <p class="text-md">{{ cat.race }}</p>
            <p class="text-sm">{{ cat.body_color }}</p>
        </div>
        <div>
            <Link :href="route('cats.show', isKitten(cat) ? { id: cat.litter.mother.id } : { id: cat.id })">
                <Button label="voir plus" class="mt-3 justify-center text-black md:self-end" />
            </Link>
        </div>
    </div>
</template>
