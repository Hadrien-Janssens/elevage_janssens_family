<script lang="ts" setup>
import Menu from '@/components/Menu.vue';
import { Link } from '@inertiajs/vue3';
import { Cake, Heart } from 'lucide-vue-next';
import { Kitten } from '../types/index';

defineProps<{
    kitten?: Kitten;
}>();

import Button from '@/components/Button.vue';
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
        <div v-if="kitten" class="mx-auto mb-8 max-w-2xl basis-1/2 p-6">
            <div class="mb-6 flex flex-col justify-between gap-4 md:flex-row">
                <div>
                    <h1 class="flex items-center gap-2 text-3xl font-bold text-gray-900">
                        {{ capitalizeFirstLetter(kitten.name) }}
                        <span v-if="kitten.gender === 'Mâle'" class="flex items-center text-blue-500"> </span>
                        <span v-else class="flex items-center text-pink-500"> </span>
                    </h1>
                    <p class="mt-1 flex items-center gap-2 text-gray-600">
                        <Cake class="text-primary h-5 w-5" />
                        <span>Né le {{ kitten.litter.birth_date }}</span>
                    </p>
                    <div class="text-primary flex items-center gap-2">
                        <Heart class="h-5 w-5 text-red-500" />
                        <span class="font-medium">Disponible pour adoption</span>
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <h2 class="mb-2 text-xl font-semibold text-gray-900">Description</h2>
                <p class="leading-relaxed text-gray-700">{{ kitten.description }}</p>
            </div>

            <div class="mb-3 flex gap-3">
                <Link :href="route('cats.show', { id: kitten.litter.mother.id })">
                    <div class="rounded-lg bg-gray-100 px-4 py-2">
                        <p class="text-sm text-gray-500">Maman</p>
                        <p class="font-medium">{{ kitten.litter.mother.name }}</p>
                    </div>
                </Link>
                <Link :href="route('cats.show', { id: kitten.litter.father.id })">
                    <div class="rounded-lg bg-gray-100 px-4 py-2">
                        <p class="text-sm text-gray-500">Papa</p>
                        <p class="font-medium">{{ kitten.litter.father.name }}</p>
                    </div>
                </Link>
            </div>

            <Link :href="route('litter.show', { litter: kitten.litter })" class="mt-4">
                <Button label="Voir la portée" />
            </Link>
        </div>
    </div>
    <Footer />
</template>
