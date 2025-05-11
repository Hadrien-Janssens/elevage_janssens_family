<script lang="ts" setup>
import CatsInformations from '@/components/CatsInformations.vue';
import DoubleCarrousel from '@/components/DoubleCarrousel.vue';
import Footer from '@/components/Footer.vue';
import Menu from '@/components/Menu.vue';
import { capitalizeFirstLetter } from '@/lib/utils';
import { ref } from 'vue';
import { Kitten } from '../types/index';

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
    <Menu :title="capitalizeFirstLetter(kitten?.name)" />
    <div class="mx-auto w-full max-w-4xl items-start gap-5 px-4 lg:mt-20 lg:flex lg:justify-center lg:py-6">
        <!-- Carrousel principal -->
        <DoubleCarrousel :cat="kitten" />
        <!-- Infos chaton -->
        <CatsInformations :kitten="kitten" :index="0" :isLiked="isLiked" @toggle-like="handleLikeToggle" />
    </div>
    <Footer />
</template>
