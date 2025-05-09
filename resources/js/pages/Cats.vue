<script lang="ts" setup>
import Menu from '@/components/Menu.vue';

defineProps({
    cats: {
        required: false,
    },
});

import CatCard from '@/components/CatCard.vue';
import DoubleCarrousel from '@/components/DoubleCarrousel.vue';
import Footer from '@/components/Footer.vue';
import { capitalizeFirstLetter } from '@/lib/utils';
import { Cake } from 'lucide-vue-next';
</script>

<template>
    <Menu title="Nos chats" />

    <div class="mx-auto py-6">
        <h2 class="poetsone mb-6 px-4 text-center text-3xl text-[#B5A9A4]">Nos reproducteurs</h2>
        <!-- mobile -->
        <div class="m-4 grid grid-cols-1 gap-6 md:hidden md:grid-cols-2">
            <CatCard
                v-for="(cat, index) in cats"
                :key="index"
                :kitten="cats"
                class="group relative overflow-hidden rounded-lg shadow-lg transition-transform duration-300 hover:scale-105"
            />
        </div>
        <!-- desktop -->
        <div v-for="(cat, index) in cats" :key="index" :class="[{ 'bg-[#F4F4F4] md:flex-row-reverse': index % 2 === 0 }, 'flex justify-center']">
            <div class="hidden w-full max-w-4xl items-start gap-5 p-5 px-4 md:flex md:justify-center">
                <!-- Carrousel principal -->
                <DoubleCarrousel :cat="cat" />

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
