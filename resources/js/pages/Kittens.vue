<script lang="ts" setup>
import Button from '@/components/Button.vue';
import CatsListing from '@/components/CatsListing.vue';
import Footer from '@/components/Footer.vue';
import Menu from '@/components/Menu.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    kittens: {
        required: false,
    },
    litters: {
        required: false,
    },
});
</script>

<template>
    <Menu title="Nos chatons" />

    <div class="mx-auto py-6">
        <h2 class="poetsone mb-6 px-4 text-center text-3xl text-[#B5A9A4]">Chatons disponibles à l'adoption</h2>
        <CatsListing :kittens="kittens" />
    </div>
    <!-- LITTERS (inchangé) -->
    <div class="m-3 my-6">
        <h2 class="poetsone mb-3 text-center text-3xl text-[#B5A9A4]">Les portées</h2>
        <ul class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            <li v-for="(litter, index) in litters" :key="index" class="relative w-full">
                <figure class="h-64 w-full overflow-hidden rounded-lg bg-gray-200">
                    <img
                        v-if="litter.images?.length"
                        :src="'/storage/litters/' + litter.images[0].image_path"
                        alt="kitten"
                        class="h-full w-full object-cover object-center"
                    />
                </figure>
                <div class="absolute bottom-0 flex w-full items-center justify-between rounded-b-lg bg-[#CDC6C2AA] p-3">
                    <p class="poetsone">
                        {{ litter?.name }}
                    </p>
                    <Link :href="route('litter.show', litter)" class="self-center">
                        <Button label="Voir plus" />
                    </Link>
                </div>
            </li>
        </ul>
    </div>

    <Footer />
</template>
