<script lang="ts" setup>
import Menu from '@/components/Menu.vue';
import { Cat } from '../types/index';

defineProps<{
    cat: Cat;
}>();

import CatsInformations from '@/components/CatsInformations.vue';
import DoubleCarrousel from '@/components/DoubleCarrousel.vue';
import Footer from '@/components/Footer.vue';
import { capitalizeFirstLetter } from '@/lib/utils';
</script>

<template>
    <Menu :title="capitalizeFirstLetter(cat?.name)" />
    <div class="mx-auto w-full max-w-4xl items-start gap-5 px-4 md:flex md:justify-center">
        <DoubleCarrousel :cat="cat" />

        <CatsInformations :kitten="cat" :index="0" />
    </div>
    <Footer />
</template>
