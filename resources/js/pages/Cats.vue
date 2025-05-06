<script lang="ts" setup>
import Button from '@/components/Button.vue';
import Menu from '@/components/Menu.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    cats: {
        required: false,
    },
});
</script>

<template>
    <Menu title="Nos chats" />

    <div class="m-3 my-6">
        <h2 class="poetsone mb-3 text-3xl text-[#B5A9A4]">Nos reproducteurs</h2>
        <ul class="flex flex-col gap-3">
            <li v-for="(cat, index) in cats" :key="index" class="relative">
                <figure class="h-64 w-full overflow-hidden rounded-lg bg-gray-200">
                    <img
                        v-if="cat.images?.length"
                        :src="'/storage/kittens/' + cat.images[0].image_path"
                        alt="cat"
                        class="h-full w-full object-cover object-center"
                    />
                </figure>
                <div class="absolute bottom-0 flex w-full items-center justify-between rounded-b-lg bg-[#CDC6C2AA] p-3">
                    <p class="poetsone">
                        {{ cat.name }}
                        <span class="text-xl font-bold" v-if="cat.gender === 'Mâle'">♂</span>
                        <span class="text-xl font-bold" v-else>♀</span>
                    </p>

                    <Link :href="route('kitten.show', cat)" class="self-center">
                        <Button label="Voir plus" />
                    </Link>
                </div>
            </li>
        </ul>
    </div>
</template>
