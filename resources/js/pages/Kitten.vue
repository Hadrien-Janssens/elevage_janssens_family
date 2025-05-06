<script lang="ts" setup>
import Menu from '@/components/Menu.vue';
import { Carousel, CarouselContent, CarouselItem } from '@/components/ui/carousel';
import { Cake, Heart } from 'lucide-vue-next';
import { Kitten } from '../types/index';

defineProps<{
    kitten?: Kitten;
}>();

import { Card, CardContent } from '@/components/ui/card';
import { type CarouselApi } from '@/components/ui/carousel';
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
    <Menu :title="kitten?.name" />
    <div class="mx-auto w-full max-w-4xl px-4">
        <!-- Carrousel principal -->
        <div class="mx-auto mb-2 max-w-lg">
            <Carousel class="max-h-[500px] w-full max-w-lg overflow-hidden rounded-xl shadow-lg" @init-api="(val) => (emblaMainApi = val)">
                <CarouselContent>
                    <CarouselItem v-for="(image, index) in kitten?.images" :key="index">
                        <div class="p-0">
                            <Card class="border-0 p-0">
                                <!-- <CardContent class="aspect-[4/3] p-0"> -->
                                <img
                                    :src="'/storage/kittens/' + image.image_path"
                                    :alt="'Photo du chaton ' + kitten?.name"
                                    class="h-full w-full object-cover"
                                />
                                <!-- </CardContent> -->
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
                        v-for="(image, index) in kitten?.images"
                        :key="index"
                        class="basis-16 cursor-pointer pl-0"
                        @click="onThumbClick(index)"
                    >
                        <div class="p-0" :class="index === selectedIndex ? 'ring-primary rounded-md ring-2' : 'opacity-80'">
                            <Card class="border-0 p-0">
                                <CardContent class="aspect-square p-0">
                                    <img
                                        :src="'/storage/kittens/' + image.image_path"
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

        <!-- Infos chaton -->
        <div v-if="kitten" class="mx-auto mb-8 max-w-2xl rounded-xl bg-white p-6 shadow-md">
            <div class="mb-6 flex flex-col justify-between gap-4 md:flex-row">
                <div>
                    <h1 class="flex items-center gap-2 text-3xl font-bold text-gray-900">
                        {{ kitten.name }}
                        <span v-if="kitten.gender === 'Mâle'" class="flex items-center text-blue-500">
                            <!-- <Mars class="h-5 w-5" /> -->
                        </span>
                        <span v-else class="flex items-center text-pink-500">
                            <!-- <Venus class="h-5 w-5" /> -->
                        </span>
                    </h1>
                    <p class="mt-1 flex items-center gap-2 text-gray-600">
                        <Cake class="text-primary h-5 w-5" />
                        <span>Né le {{ kitten.litter.birth_date }}</span>
                    </p>
                </div>

                <div class="flex gap-3">
                    <div class="rounded-lg bg-pink-100 px-4 py-2">
                        <p class="text-sm text-pink-500">Maman</p>
                        <p class="font-medium">{{ kitten.litter.mother.name }}</p>
                    </div>
                    <div class="rounded-lg bg-blue-100 px-4 py-2">
                        <p class="text-sm text-blue-500">Papa</p>
                        <p class="font-medium">{{ kitten.litter.father.name }}</p>
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <h2 class="mb-2 text-xl font-semibold text-gray-900">Description</h2>
                <p class="leading-relaxed text-gray-700">{{ kitten.description }}</p>
            </div>

            <div class="text-primary flex items-center gap-2">
                <Heart class="h-5 w-5 text-red-500" />
                <span class="font-medium">Disponible pour adoption</span>
            </div>
        </div>
    </div>
</template>
