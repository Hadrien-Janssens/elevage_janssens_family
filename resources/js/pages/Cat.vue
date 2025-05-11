<script lang="ts" setup>
import CatsInformations from '@/components/CatsInformations.vue';
import DoubleCarrousel from '@/components/DoubleCarrousel.vue';
import Menu from '@/components/Menu.vue';
import { capitalizeFirstLetter } from '@/lib/utils';
import { Cat } from '../types/index';
import Layout from './Layout.vue';

defineProps<{
    cat: Cat;
}>();
</script>

<template>
    <Head>
        <title>{{ capitalizeFirstLetter(cat?.name) }} - Janssens Family</title>
        <meta
            name="description"
            content="Découvrez {{ capitalizeFirstLetter(cat?.name) }}, un de nos magnifiques chats chez Janssens Family, élevage familial de Scottish et British."
        />
        <meta name="keywords" content="chat, Scottish, British, élevage familial, Janssens Family, {{ cat?.name }}" />
        <meta name="author" content="Janssens Family" />
        <meta property="og:title" content="{{ capitalizeFirstLetter(cat?.name) }} - Janssens Family" />
        <meta
            property="og:description"
            content="Découvrez {{ capitalizeFirstLetter(cat?.name) }}, un de nos magnifiques chats chez Janssens Family, élevage familial de Scottish et British."
        />
        <meta property="og:image" content="/images/cats/{{ cat?.id }}.jpg" />
        <meta property="og:url" content="https://www.janssensfamily.be/cat/{{ cat?.id }}" />
        <meta property="og:type" content="website" />
    </Head>

    <Menu :title="capitalizeFirstLetter(cat?.name)" />
    <Layout>
        <div class="mx-auto w-full max-w-4xl items-start gap-5 px-4 md:flex md:justify-center lg:mt-20 lg:py-6">
            <DoubleCarrousel :cat="cat" />

            <CatsInformations :kitten="cat" :index="0" />
        </div>
    </Layout>
</template>
