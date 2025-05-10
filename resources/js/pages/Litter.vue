<script lang="ts" setup>
import Menu from '@/components/Menu.vue';
import { Kitten, Litter } from '../types/index';

defineProps<{
    kittens: Kitten[];
    litter: Litter;
}>();

import CatsListing from '@/components/CatsListing.vue';
import DoubleCarrousel from '@/components/DoubleCarrousel.vue';
import ParentCard from '@/components/ParentCard.vue';
import { capitalizeFirstLetter } from '@/lib/utils';
import { Cake } from 'lucide-vue-next';
</script>

<template>
    <Menu :title="capitalizeFirstLetter(litter?.name)" />
    <div class="mx-auto w-full">
        <div class="flex">
            <DoubleCarrousel :cat="litter" />

            <div class="mb-6 flex flex-col gap-4 px-4">
                <div>
                    <h1 class="flex gap-2 text-3xl font-bold text-gray-900">
                        {{ capitalizeFirstLetter(litter.name) }}
                    </h1>
                </div>
                <div class="flex gap-3">
                    <ParentCard :name="litter.mother.name" parent="Maman" :index="0" />
                    <ParentCard :name="litter.mother.name" parent="Papa" :index="0" />
                </div>
                <p class="flex items-center gap-2"><Cake /> Date de naissance : {{ litter.birth_date }}</p>
            </div>
        </div>

        <!-- Carrousel principal -->

        <h2 class="poetsone flex items-center gap-2 px-4 text-3xl font-bold text-gray-900">Les chatons de cette portée</h2>
        <CatsListing :kittens="kittens" />
    </div>
</template>
