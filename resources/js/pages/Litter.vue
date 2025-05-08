<script lang="ts" setup>
import Menu from '@/components/Menu.vue';
import { Carousel, CarouselContent, CarouselItem } from '@/components/ui/carousel';
import { Kitten, Litter } from '../types/index';

defineProps<{
    kittens?: Kitten[];
    litter?: Litter;
}>();

import CatsListing from '@/components/CatsListing.vue';
import { Card, CardContent } from '@/components/ui/card';
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
    <Menu :title="capitalizeFirstLetter(litter?.name)" />
    <div class="mx-auto w-full max-w-4xl px-4">
        <div class="mb-6 flex flex-col justify-between gap-4 md:flex-row">
            <div>
                <h1 class="flex items-center gap-2 text-3xl font-bold text-gray-900">
                    {{ capitalizeFirstLetter(litter.name) }}
                </h1>
            </div>
            <p>Date de naissance : {{ litter.birth_date }}</p>
        </div>

        <CatsListing :kittens="kittens" />

        <!-- Carrousel principal -->
        <div class="mx-auto mb-2 max-w-lg">
            <h1 class="flex items-center gap-2 text-3xl font-bold text-gray-900">Photos de groupe</h1>
            <Carousel class="max-h-[500px] w-full max-w-lg overflow-hidden rounded-xl shadow-lg" @init-api="(val) => (emblaMainApi = val)">
                <CarouselContent>
                    <CarouselItem v-for="(image, index) in litter?.images" :key="index">
                        <div class="p-0">
                            <Card class="border-0 p-0">
                                <img
                                    :src="'/storage/litters/' + image.image_path"
                                    :alt="'Photo du chaton ' + litter?.name"
                                    class="h-full w-full object-cover"
                                />
                            </Card>
                        </div>
                    </CarouselItem>
                </CarouselContent>
            </Carousel>
        </div>

        <!-- Miniatures -->
        <div class="mx-auto mb-8 max-w-lg">
            <Carousel class="w-full" @init-api="(val) => (emblaThumbnailApi = val)">
                <CarouselContent class="ml-0 flex gap-2 p-2">
                    <CarouselItem
                        v-for="(image, index) in litter?.images"
                        :key="index"
                        class="basis-16 cursor-pointer pl-0"
                        @click="onThumbClick(index)"
                    >
                        <div class="p-0" :class="index === selectedIndex ? 'ring-primary rounded-md ring-2' : 'opacity-80'">
                            <Card class="border-0 p-0">
                                <CardContent class="aspect-square p-0">
                                    <img
                                        :src="'/storage/litters/' + image.image_path"
                                        :alt="'Miniature ' + (index + 1)"
                                        class="h-full w-full rounded-md object-cover"
                                    />
                                </CardContent>
                            </Card>
                        </div>
                    </CarouselItem>
                </CarouselContent>
            </Carousel>
        </div>
    </div>
</template>
