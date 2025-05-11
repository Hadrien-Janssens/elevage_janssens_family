<script lang="ts" setup>
import CatsListing from '@/components/CatsListing.vue';
import Menu from '@/components/Menu.vue';
import { Cat } from '@/types';
import Layout from './Layout.vue';

defineProps<{
    cats: Cat[];
}>();
</script>

<template>
    <Head>
        <title>Nos chats - Janssens Family</title>
        <meta name="description" content="Découvrez nos reproducteurs chez Janssens Family, élevage familial de Scottish et British." />
        <meta name="keywords" content="chats, reproducteurs, Scottish, British, élevage familial, Janssens Family" />
        <meta name="author" content="Janssens Family" />
        <meta property="og:title" content="Nos chats - Janssens Family" />
        <meta property="og:description" content="Découvrez nos reproducteurs chez Janssens Family, élevage familial de Scottish et British." />
        <meta property="og:image" content="/images/reproducteurs.jpg" />
        <meta property="og:url" content="https://www.janssensfamily.be/cats" />
        <meta property="og:type" content="website" />
    </Head>

    <Menu title="Nos chats" />

    <Layout>
        <div class="mx-auto overflow-hidden lg:mt-20 lg:py-6">
            <h2 class="poetsone px-4 text-center text-3xl text-[#B5A9A4]">Nos reproducteurs</h2>
            <CatsListing :kittens="cats" />
        </div>
    </Layout>
</template>
