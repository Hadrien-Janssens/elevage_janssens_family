<script lang="ts" setup>
import CatsInformations from '@/components/CatsInformations.vue';
import DoubleCarrousel from '@/components/DoubleCarrousel.vue';
import Menu from '@/components/Menu.vue';
import { capitalizeFirstLetter } from '@/lib/utils';
import { ref } from 'vue';
import { Kitten } from '../types/index';
import Layout from './Layout.vue';

const props = defineProps<{
    kitten: Kitten;
}>();

const isLiked = ref(localStorage.getItem(`liked_${props.kitten.id}`) === 'true');

// Fonction pour gérer les likes
const handleLikeToggle = (kittenId: number) => {
    localStorage.setItem(`liked_${kittenId}`, `${!isLiked.value}`);
    isLiked.value = !isLiked.value;
};
</script>

<template>
    <Head>
        <title>{{ capitalizeFirstLetter(kitten?.name) }} - Janssens Family</title>
        <meta
            name="description"
            content="Découvrez {{ capitalizeFirstLetter(kitten?.name) }}, un de nos adorables chatons disponibles à l'adoption chez Janssens Family, élevage familial de Scottish et British."
        />
        <meta name="keywords" content="chaton, adoption, Scottish, British, élevage familial, Janssens Family, {{ kitten?.name }}" />
        <meta name="author" content="Janssens Family" />
        <meta property="og:title" content="{{ capitalizeFirstLetter(kitten?.name) }} - Janssens Family" />
        <meta
            property="og:description"
            content="Découvrez {{ capitalizeFirstLetter(kitten?.name) }}, un de nos adorables chatons disponibles à l'adoption chez Janssens Family, élevage familial de Scottish et British."
        />
        <meta property="og:image" content="/images/kittens/{{ kitten?.id }}.jpg" />
        <meta property="og:url" content="https://www.janssensfamily.be/kitten/{{ kitten?.id }}" />
        <meta property="og:type" content="website" />
    </Head>

    <Menu :title="capitalizeFirstLetter(kitten?.name)" />
    <Layout>
        <div class="mx-auto w-full max-w-4xl items-start gap-5 px-4 lg:mt-20 lg:flex lg:justify-center lg:py-6">
            <!-- Carrousel principal -->
            <DoubleCarrousel :cat="kitten" />
            <!-- Infos chaton -->
            <CatsInformations :kitten="kitten" :index="0" :isLiked="isLiked" @toggle-like="handleLikeToggle" />
        </div>
    </Layout>
</template>
