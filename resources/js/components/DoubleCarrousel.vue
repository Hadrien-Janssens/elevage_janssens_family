<script setup lang="ts">
import { Card, CardContent } from '@/components/ui/card';
import { Carousel, CarouselContent, CarouselItem, type CarouselApi } from '@/components/ui/carousel';
import { isKitten, isLitter } from '@/lib/utils';
import { Cat, Kitten, Litter } from '@/types';
import { watchOnce } from '@vueuse/core';
import { ref } from 'vue';

defineProps<{
    cat: Cat | Kitten | Litter;
}>();

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
    <!-- Carrousel principal -->
    <div class="basis-1/2">
        <div class="mx-auto mb-2 max-w-lg">
            <Carousel class="w-full max-w-lg overflow-hidden rounded-xl shadow-lg" @init-api="(val) => (emblaMainApi = val)">
                <CarouselContent>
                    <CarouselItem v-for="(image, index) in cat?.images" :key="index">
                        <div class="p-0">
                            <Card class="relative h-[350px] w-full border-0 p-0">
                                <!-- Bandeau "Réservé" -->
                                <div v-if="isKitten(cat) && cat.is_booked" class="absolute -top-10 -right-18 z-10 w-52 text-center">
                                    <div
                                        class="text-primary -translate-x-7 translate-y-20 rotate-45 transform bg-white px-2 py-1 text-center text-lg font-black uppercase shadow-md"
                                    >
                                        Réservé
                                    </div>
                                </div>
                                <div v-if="isKitten(cat) && cat.is_adopted" class="absolute -top-10 -right-18 z-10 w-50 text-center">
                                    <div
                                        class="text-primary -translate-x-7 translate-y-20 rotate-45 transform bg-white px-2 py-1 text-center text-lg font-black uppercase shadow-md"
                                    >
                                        Adopté
                                    </div>
                                </div>
                                <img
                                    v-if="isLitter(cat)"
                                    :src="'/storage/litters/' + image.image_path"
                                    :alt="'Photo du chaton ' + cat?.name"
                                    class="h-full w-full object-cover object-center"
                                />
                                <div v-else class="h-full w-full">
                                    <img
                                        v-if="isKitten(cat)"
                                        :src="'/storage/kittens/' + image.image_path"
                                        :alt="'Photo du chaton ' + cat?.name"
                                        class="h-full w-full object-cover object-center"
                                    />

                                    <img
                                        v-else
                                        :src="'/storage/cats/' + image.image_path"
                                        :alt="'Photo du chaton ' + cat?.name"
                                        class="h-full w-full object-cover object-center"
                                    />
                                </div>
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
                        v-for="(image, index) in cat?.images"
                        :key="index"
                        class="basis-16 cursor-pointer pl-0"
                        @click="onThumbClick(index)"
                    >
                        <div class="p-0" :class="index === selectedIndex ? 'ring-primary rounded-md ring-2' : 'opacity-80'">
                            <Card class="border-0 p-0">
                                <CardContent class="aspect-square p-0">
                                    <img
                                        v-if="isLitter(cat)"
                                        :src="'/storage/litters/' + image.image_path"
                                        :alt="'Miniature ' + (index + 1)"
                                        class="h-full w-full rounded-md object-cover object-center"
                                    />
                                    <div v-else>
                                        <img
                                            v-if="isKitten(cat)"
                                            :src="'/storage/kittens/' + image.image_path"
                                            :alt="'Miniature ' + (index + 1)"
                                            class="h-full w-full rounded-md object-cover object-center"
                                        />

                                        <img
                                            v-else
                                            :src="'/storage/cats/' + image.image_path"
                                            :alt="'Miniature ' + (index + 1)"
                                            class="h-full w-full rounded-md object-cover object-center"
                                        />
                                    </div>
                                </CardContent>
                            </Card>
                        </div>
                    </CarouselItem>
                </CarouselContent>
            </Carousel>
        </div>
    </div>
</template>
