<script lang="ts" setup>
import { type CarouselApi } from '@/components/ui/carousel';
import { capitalizeFirstLetter } from '@/lib/utils';
import { Link } from '@inertiajs/vue3';
import { watchOnce } from '@vueuse/core';
import { Cake, Heart, HeartCrack } from 'lucide-vue-next';
import { ref } from 'vue';
import CatCard from './CatCard.vue';
import DoubleCarrousel from './DoubleCarrousel.vue';

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
defineProps({
    kittens: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <!-- mobile -->
    <div v-if="kittens.length > 0" class="m-4 grid grid-cols-1 gap-6 md:hidden md:grid-cols-2">
        <CatCard
            v-for="(kitten, index) in kittens"
            :key="index"
            :kitten="kitten"
            class="group relative overflow-hidden rounded-lg shadow-lg transition-transform duration-300 hover:scale-105"
        />
    </div>
    <p v-else class="poetsone px-4 text-center text-xl text-[#B5A9A4]">Aucun chaton disponible à l'adoption pour le moment.</p>

    <!-- desktop -->
    <div v-for="(kitten, index) in kittens" :key="index" :class="[{ 'bg-[#F4F4F4]': index % 2 === 0 }, 'flex justify-center py-10']">
        <div
            class="hidden w-full max-w-4xl items-start gap-5 p-5 px-4 md:flex md:justify-center"
            :class="[{ 'md:flex-row-reverse': index % 2 === 1 }]"
        >
            <!-- Carrousel principal -->
            <DoubleCarrousel :cat="kitten" />

            <!-- Infos chaton -->
            <div class="relative mx-auto mb-8 max-w-2xl shrink-0 basis-1/2 p-6 pl-10">
                <!--   :class="[{ 'md:flex-row-reverse': index % 2 === 1 }]" -->
                <div
                    class="border-primary absolute top-0 h-30 w-52"
                    :class="[
                        { 'left-0 rounded-tl-xl border-t-2 border-l-2': index % 2 === 1 },
                        { 'right-0 rounded-tr-xl border-t-2 border-r-2': index % 2 === 0 },
                    ]"
                ></div>

                <div
                    class="border-primary absolute right-0 bottom-0 h-30 w-52 rounded-br-xl border-r-2 border-b-2"
                    :class="[{ '': index % 2 === 0 }]"
                ></div>

                <div class="mb-6 flex flex-col justify-between gap-4 md:flex-row">
                    <div>
                        <h1 class="text-primary flex items-center gap-2 text-3xl font-bold">
                            {{ capitalizeFirstLetter(kitten.name) }}
                            <span v-if="kitten.gender === 'Mâle'" class="flex items-center text-gray-500"> </span>
                            <span v-else class="flex items-center text-gray-500"> </span>
                        </h1>
                        <p class="mt-1 flex items-center gap-2 text-gray-600">
                            <Cake class="text-primary h-5 w-5" />
                            <span>Né le {{ kitten.litter.birth_date }}</span>
                        </p>
                    </div>
                </div>

                <div class="mb-6">
                    <h2 class="mb-2 text-xl font-semibold text-gray-900">Description</h2>
                    <p class="leading-relaxed text-gray-700">{{ kitten.description }}</p>
                </div>

                <div class="mb-5 flex gap-3">
                    <Link :href="route('cats.show', { id: kitten.litter.mother.id })">
                        <div class="rounded-lg bg-gray-100 px-4 py-2" :class="[{ 'bg-white': index % 2 === 0 }]">
                            <p class="text-sm text-gray-500">Maman</p>
                            <p class="font-medium">{{ kitten.litter.mother.name }}</p>
                        </div>
                    </Link>
                    <Link :href="route('cats.show', { id: kitten.litter.father.id })">
                        <div class="rounded-lg bg-gray-100 px-4 py-2" :class="[{ 'bg-white': index % 2 === 0 }]">
                            <p class="text-sm text-gray-500">Papa</p>
                            <p class="font-medium">{{ kitten.litter.father.name }}</p>
                        </div>
                    </Link>
                </div>

                <p>Status</p>
                <div v-if="!kitten.is_booked" class="text-primary flex items-center gap-2">
                    <Heart class="h-5 w-5 text-red-500" />
                    <span class="font-medium">Disponible pour adoption</span>
                </div>
                <div v-else class="text-primary flex items-center gap-2">
                    <HeartCrack class="h-5 w-5 text-red-500" />
                    <span class="font-medium">Ce chaton est réservé</span>
                </div>
            </div>
        </div>
    </div>
</template>
