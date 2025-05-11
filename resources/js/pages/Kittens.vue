<script lang="ts" setup>
import CatCard from '@/components/CatCard.vue';
import CatsListing from '@/components/CatsListing.vue';
import Footer from '@/components/Footer.vue';
import Menu from '@/components/Menu.vue';
import { Kitten, Litter } from '@/types';

defineProps<{
    kittens: Kitten[];
    litters: Litter[];
}>();
</script>

<template>
    <Menu title="Nos chatons" />

    <div class="mx-auto lg:mt-20 lg:py-6">
        <h2 class="poetsone px-4 text-center text-3xl text-[#B5A9A4]">Chatons disponibles à l'adoption</h2>
        <CatsListing :kittens="kittens" />
    </div>
    <!-- LITTERS (inchangé) -->
    <div v-if="litters.length" class="m-3 my-6">
        <h2 class="poetsone mb-3 text-center text-3xl text-[#B5A9A4]">Les portées</h2>

        <ul class="mx-auto grid max-w-4xl grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3">
            <li v-for="(litter, index) in litters" :key="index" class="relative w-full">
                <CatCard :kitten="litter" />
            </li>
        </ul>
    </div>

    <Footer />
</template>
