<script lang="ts" setup>
import Menu from '@/components/Menu.vue';
import { Cake } from 'lucide-vue-next';
import { Cat } from '../types/index';

defineProps<{
    cat?: Cat;
}>();

import DoubleCarrousel from '@/components/DoubleCarrousel.vue';
import Footer from '@/components/Footer.vue';
import { type CarouselApi } from '@/components/ui/carousel';
import { capitalizeFirstLetter } from '@/lib/utils';
import { watchOnce } from '@vueuse/core';
import { ref } from 'vue';

const emblaMainApi = ref<CarouselApi>();
const emblaThumbnailApi = ref<CarouselApi>();
const selectedIndex = ref(0);

function onSelect() {
    if (!emblaMainApi.value || !emblaThumbnailApi.value) return;
    selectedIndex.value = emblaMainApi.value.selectedScrollSnap();
    emblaThumbnailApi.value.scrollTo(emblaMainApi.value.selectedScrollSnap());
}

function onThumbClick(index: number) {
    if (!emblaMainApi.value || !emblaThumbnailApi.value) return;
    emblaMainApi.value.scrollTo(index);
}

watchOnce(emblaMainApi, (emblaMainApi) => {
    if (!emblaMainApi) return;

    onSelect();
    emblaMainApi.on('select', onSelect);
    emblaMainApi.on('reInit', onSelect);
});
</script>

<template>
    <Menu :title="capitalizeFirstLetter(cat?.name)" />
    <div class="mx-auto w-full max-w-4xl items-start gap-5 px-4 md:flex md:justify-center">
        <!-- Carrousel principal -->
        <DoubleCarrousel :cat="cat" />

        <!-- Infos chat -->
        <div v-if="cat" class="mx-auto mb-8 max-w-2xl basis-1/2 p-6">
            <div class="mb-6 flex flex-col justify-between gap-4 md:flex-row">
                <div>
                    <h1 class="flex items-center gap-2 text-3xl font-bold text-gray-900">
                        {{ capitalizeFirstLetter(cat.name) }}
                        <span v-if="cat.gender === 'Mâle'" class="flex items-center text-blue-500"> </span>
                        <span v-else class="flex items-center text-pink-500"> </span>
                    </h1>
                    <p class="mt-1 flex items-center gap-2 text-gray-600">
                        <Cake class="text-primary h-5 w-5" />
                        <span>Né le {{ cat.birthday }}</span>
                    </p>
                </div>
            </div>

            <div class="mb-6">
                <h2 class="mb-2 text-xl font-semibold text-gray-900">Description</h2>
                <p class="leading-relaxed text-gray-700">{{ cat.description }}</p>
            </div>
        </div>
    </div>
    <Footer />
</template>
