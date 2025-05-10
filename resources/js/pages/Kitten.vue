<script lang="ts" setup>
import Menu from '@/components/Menu.vue';
import { Kitten } from '../types/index';

defineProps<{
    kitten: Kitten;
}>();

import CatsInformations from '@/components/CatsInformations.vue';
import DoubleCarrousel from '@/components/DoubleCarrousel.vue';
import Footer from '@/components/Footer.vue';
import { capitalizeFirstLetter } from '@/lib/utils';
</script>

<template>
    <Menu :title="capitalizeFirstLetter(kitten?.name)" />
    <div class="mx-auto w-full max-w-4xl items-start gap-5 px-4 lg:flex lg:justify-center">
        <!-- Carrousel principal -->
        <DoubleCarrousel :cat="kitten" />
        <!-- Infos chaton -->
        <CatsInformations :kitten="kitten" :index="0" />
    </div>
    <Footer />
</template>
