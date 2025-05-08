<script lang="ts" setup>
import { Link } from '@inertiajs/vue3';
import Button from './Button.vue';

defineProps({
    kitten: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div class="group relative overflow-hidden rounded-lg shadow-lg transition-transform duration-300 hover:scale-105">
        <figure class="relative h-72 w-full overflow-hidden">
            <img
                v-if="kitten.images?.length"
                :src="'/storage/kittens/' + kitten.images[0].image_path"
                alt="Photo de {{ kitten.name }}"
                class="h-full w-full object-cover object-center transition-transform duration-500 group-hover:scale-110"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
        </figure>
        <div class="absolute right-0 bottom-0 left-0 flex items-center justify-between p-4 text-white">
            <p class="poetsone text-xl">
                {{ kitten.name }}
                <span class="ml-1 text-2xl font-bold" v-if="kitten.gender === 'Mâle'">♂</span>
                <span class="ml-1 text-2xl font-bold" v-else>♀</span>
            </p>
            <div class="mt-2 flex justify-end">
                <Link :href="route('kitten.show', kitten)">
                    <Button label="Voir plus" class="bg-white/90 text-[#B5A9A4] hover:bg-white" />
                </Link>
            </div>
        </div>
    </div>
</template>
