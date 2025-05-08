<script lang="ts" setup>
import Button from '@/components/Button.vue';
import Menu from '@/components/Menu.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    cats: {
        required: false,
    },
});

import Footer from '@/components/Footer.vue';
import { Card, CardContent } from '@/components/ui/card';
import { Carousel, CarouselContent, CarouselItem, type CarouselApi } from '@/components/ui/carousel';
import { capitalizeFirstLetter } from '@/lib/utils';
import { watchOnce } from '@vueuse/core';
import { Cake } from 'lucide-vue-next';
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
    <Menu title="Nos chats" />

    <div class="mx-auto py-6">
        <h2 class="poetsone mb-6 px-4 text-center text-3xl text-[#B5A9A4]">Nos reproducteurs</h2>
        <!-- mobile -->
        <div class="m-4 grid grid-cols-1 gap-6 md:hidden md:grid-cols-2">
            <div
                v-for="(cat, index) in cats"
                :key="index"
                class="group relative overflow-hidden rounded-lg shadow-lg transition-transform duration-300 hover:scale-105 hover:shadow-md"
            >
                <figure class="relative h-72 w-full overflow-hidden">
                    <img
                        v-if="cat.images?.length"
                        :src="'/storage/cats/' + cat.images[0].image_path"
                        alt="Photo de {{ cat.name }}"
                        class="h-full w-full object-cover object-center transition-transform duration-500 group-hover:scale-110"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                </figure>
                <div class="absolute right-0 bottom-0 left-0 flex items-center justify-between p-4 text-white">
                    <p class="poetsone text-xl">
                        {{ cat.name }}
                        <span class="ml-1 text-2xl font-bold" v-if="cat.gender === 'Mâle'">♂</span>
                        <span class="ml-1 text-2xl font-bold" v-else>♀</span>
                    </p>
                    <div class="mt-2 flex justify-end">
                        <Link :href="route('cats.show', cat)">
                            <Button label="Voir plus" class="text-black" />
                        </Link>
                    </div>
                </div>
            </div>
        </div>
        <!-- desktop -->
        <div v-for="(cat, index) in cats" :key="index" :class="[{ 'bg-[#F4F4F4] md:flex-row-reverse': index % 2 === 0 }, 'flex justify-center']">
            <div class="hidden w-full max-w-4xl items-start gap-5 p-5 px-4 md:flex md:justify-center">
                <!-- Carrousel principal -->
                <div class="basis-1/2">
                    <div class="mx-auto my-2 max-w-lg">
                        <Carousel class="w-full max-w-lg overflow-hidden rounded-xl shadow-lg" @init-api="(val) => (emblaMainApi = val)">
                            <CarouselContent>
                                <CarouselItem v-for="(image, index) in cat?.images" :key="index">
                                    <div class="p-0">
                                        <Card class="h-[350px] w-full border-0 bg-red-300 p-0">
                                            <img
                                                :src="'/storage/cats/' + image.image_path"
                                                :alt="'Photo du chaton ' + cat?.name"
                                                class="h-full w-full object-cover object-center"
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
                                    v-for="(image, index) in cat?.images"
                                    :key="index"
                                    class="basis-16 cursor-pointer pl-0"
                                    @click="onThumbClick(index)"
                                >
                                    <div class="p-0" :class="index === selectedIndex ? 'ring-primary rounded-md ring-2' : 'opacity-80'">
                                        <Card class="border-0 p-0">
                                            <CardContent class="aspect-square p-0">
                                                <img
                                                    :src="'/storage/cats/' + image.image_path"
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

                <!-- Infos chat -->
                <div v-if="cat" class="mx-auto mb-8 max-w-2xl shrink-0 basis-1/2 p-6">
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
        </div>
    </div>
    <Footer />
</template>
