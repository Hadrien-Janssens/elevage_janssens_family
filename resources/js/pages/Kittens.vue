<script lang="ts" setup>
import Button from '@/components/Button.vue';
import Menu from '@/components/Menu.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    kittens: {
        required: false,
    },
});

console.log(props.kittens[0].images[0].image_path);
</script>

<template>
    <Menu title="Nos chatons" />

    <div class="m-3 my-6">
        <h2 class="poetsone mb-3 text-3xl text-[#B5A9A4]">Chatons disponible à l'adoption</h2>
        <ul class="flex flex-col gap-3">
            <li v-for="(kitten, index) in kittens" :key="index" class="relative">
                <figure class="h-64 w-full overflow-hidden rounded-lg bg-gray-200">
                    <img
                        v-if="kitten.images?.length"
                        :src="kitten.images[0].image_path"
                        alt="kitten"
                        class="h-full w-full object-cover object-center"
                    />
                </figure>
                <div class="absolute bottom-0 flex w-full items-center justify-between rounded-b-lg bg-[#CDC6C2AA] p-3">
                    <p class="poetsone">
                        {{ kitten.name }}
                        <span class="text-xl font-bold" v-if="kitten.gender === 'Mâle'">♂</span>
                        <span class="text-xl font-bold" v-else>♀</span>
                    </p>

                    <Link :href="route('kitten.show', kitten)" class="self-center">
                        <Button label="Voir plus" />
                    </Link>
                </div>
            </li>
        </ul>
    </div>

    <!-- LITTERS -->
    <div class="m-3 my-6">
        <h2 class="poetsone mb-3 text-3xl text-[#B5A9A4]">Les portées</h2>
        <ul class="flex flex-col gap-3">
            <li v-for="(kitten, index) in kittens" :key="index" class="relative">
                <figure class="h-64 w-full overflow-hidden rounded-lg bg-gray-200">
                    <img
                        v-if="kitten.images?.length"
                        :src="kitten.images[0].image_path"
                        alt="kitten"
                        class="h-full w-full object-cover object-center"
                    />
                </figure>
                <div class="absolute bottom-0 flex w-full items-center justify-between rounded-b-lg bg-[#CDC6C2AA] p-3">
                    <p class="poetsone">
                        {{ kitten.name }}
                        <span class="text-xl font-bold" v-if="kitten.gender === 'Mâle'">♂</span>
                        <span class="text-xl font-bold" v-else>♀</span>
                    </p>
                </div>
            </li>
        </ul>
    </div>
</template>
