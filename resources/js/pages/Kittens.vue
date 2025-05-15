<script lang="ts" setup>
import CatCard from '@/components/CatCard.vue';
import CatsListing from '@/components/CatsListing.vue';
import Menu from '@/components/Menu.vue';
import { Kitten, Litter } from '@/types';
import { Head } from '@inertiajs/vue3';
import Layout from './Layout.vue';

defineProps<{
    kittens: Kitten[];
    litters: Litter[];
}>();
</script>

<template>
    <Head>
        <title>Nos chatons</title>
        <meta
            name="description"
            content="Découvrez nos chatons disponibles à l'adoption chez Janssens Family, élevage familial de Scottish et British."
        />
        <meta name="keywords" content="chatons, adoption, Scottish, British, élevage familial, Janssens Family" />
        <meta name="author" content="Janssens Family" />
        <meta property="og:title" content="Nos chatons - Janssens Family" />
        <meta
            property="og:description"
            content="Découvrez nos chatons disponibles à l'adoption chez Janssens Family, élevage familial de Scottish et British."
        />
        <meta property="og:image" content="/images/chatons.jpg" />
        <meta property="og:url" content="https://www.janssensfamily.be/kittens" />
        <meta property="og:type" content="website" />
    </Head>

    <Menu title="Nos chatons" />

    <Layout>
        <div class="mx-auto overflow-hidden lg:mt-20 lg:py-6">
            <h2 class="poetsone text-primary px-4 text-center text-3xl">Chatons disponibles à l'adoption</h2>
            <CatsListing :kittens="kittens" />
        </div>
        <!-- LITTERS -->
        <div v-if="litters.length" class="m-3 my-6">
            <h2 class="poetsone mb-3 text-center text-3xl text-[#B5A9A4]">Les portées</h2>

            <ul class="mx-auto grid max-w-4xl grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3">
                <li v-for="(litter, index) in litters" :key="index" class="relative w-full">
                    <CatCard :kitten="litter" />
                </li>
            </ul>
        </div>
    </Layout>
</template>
