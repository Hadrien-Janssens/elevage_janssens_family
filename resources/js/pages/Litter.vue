<script lang="ts" setup>
import Menu from '@/components/Menu.vue';
import { Kitten, Litter } from '../types/index';

defineProps<{
    kittens?: Kitten[];
    litter?: Litter;
}>();

import CatsListing from '@/components/CatsListing.vue';
import DoubleCarrousel from '@/components/DoubleCarrousel.vue';
import { capitalizeFirstLetter } from '@/lib/utils';
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
        <DoubleCarrousel :cat="litter" />
    </div>
</template>
