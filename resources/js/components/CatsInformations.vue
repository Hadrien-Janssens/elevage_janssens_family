<script lang="ts" setup>
import { capitalizeFirstLetter, isKitten } from '@/lib/utils';
import { Cat, Kitten } from '@/types';
import { Link } from '@inertiajs/vue3';
import { Cake, Heart, HeartCrack } from 'lucide-vue-next';

defineProps<{
    kitten: Kitten | Cat;
    index: number;
}>();
</script>
<template>
    <!-- Infos chatons et chats -->
    <div class="relative mx-auto mb-8 min-h-[350px] max-w-2xl shrink-0 basis-1/2 p-6 pl-10">
        <div
            class="border-primary absolute top-0 h-30 w-52"
            :class="[
                { 'left-0 rounded-tl-xl border-t-2 border-l-2': index % 2 === 1 },
                { 'right-0 rounded-tr-xl border-t-2 border-r-2': index % 2 === 0 },
            ]"
        ></div>

        <div
            :class="[
                { 'border-primary absolute right-0 bottom-0 h-30 w-52 rounded-br-xl border-r-2 border-b-2': index % 2 === 0 },
                { 'border-primary absolute bottom-0 left-0 h-30 w-52 rounded-bl-xl border-b-2 border-l-2': index % 2 === 1 },
            ]"
        ></div>

        <div class="mb-6 flex flex-col justify-between gap-4 md:flex-row">
            <div>
                <h1 class="text-primary flex items-center gap-2 text-3xl font-bold">
                    {{ capitalizeFirstLetter(kitten.name) }}
                    <span v-if="kitten.gender === 'Mâle'" class="flex items-center text-gray-500"> </span>
                    <span v-else class="flex items-center text-gray-500"> </span>
                </h1>
                <p class="mt-1 flex items-center gap-2 text-gray-600">
                    <Cake class="h-5 w-5 text-[#51687F]" />
                    <span v-if="isKitten(kitten)">Né le {{ kitten.litter.birth_date }}</span>
                    <span v-else>Né le {{ kitten.birthday }}</span>
                </p>
            </div>
        </div>

        <div class="mb-6">
            <h2 class="mb-2 text-xl font-semibold text-gray-900">Description</h2>
            <p class="leading-relaxed text-gray-700">{{ kitten.description }}</p>
        </div>

        <div class="mb-5 flex gap-3" v-if="isKitten(kitten) && kitten.litter">
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

        <div v-if="isKitten(kitten)">
            <p>Status</p>
            <div v-if="!isKitten(kitten)" class="text-primary flex items-center gap-2">
                <Heart class="h-5 w-5 text-red-500" />
                <span class="font-medium">Disponible pour adoption</span>
            </div>
            <div v-else class="text-primary flex items-center gap-2">
                <HeartCrack class="h-5 w-5 text-red-500" />
                <span class="font-medium">Ce chaton est réservé</span>
            </div>
        </div>
    </div>
</template>
