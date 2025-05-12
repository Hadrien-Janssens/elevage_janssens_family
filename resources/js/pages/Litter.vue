<script lang="ts" setup>
import Menu from '@/components/Menu.vue';
import { Kitten, Litter } from '../types/index';

const props = defineProps<{
    kittens: Kitten[];
    litter: Litter;
}>();

import CatCard from '@/components/CatCard.vue';
import DoubleCarrousel from '@/components/DoubleCarrousel.vue';
import ParentCard from '@/components/ParentCard.vue';
import { capitalizeFirstLetter } from '@/lib/utils';
import { Head } from '@inertiajs/vue3';
import { Cake } from 'lucide-vue-next';
import { reactive, ref } from 'vue';
import Layout from './Layout.vue';

const index = ref(0);

// État réactif pour suivre les likes
const likes = reactive<Record<number, boolean>>({});

// Initialisation des likes depuis localStorage
props.kittens.forEach((kitten) => {
    const storageKey = `liked_${kitten.id}`;
    likes[kitten.id] = localStorage.getItem(storageKey) === 'true';
});

// Fonction pour gérer les likes
const handleLikeToggle = (kittenId: number) => {
    likes[kittenId] = !likes[kittenId];
    localStorage.setItem(`liked_${kittenId}`, likes[kittenId].toString());
};
</script>

<template>
    <Head>
        <title>{{ litter.name }} - Janssens Family</title>
        <meta
            name="description"
            content="Découvrez la portée {{ litter.name }} de l'élevage Janssens Family, éleveur familial de Scottish et British."
        />
        <meta name="keywords" content="portée, chatons, Scottish, British, élevage familial, Janssens Family" />
        <meta name="author" content="Janssens Family" />
        <meta property="og:title" content="{{ litter.name }} - Janssens Family" />
        <meta
            property="og:description"
            content="Découvrez la portée {{ litter.name }} de l'élevage Janssens Family, éleveur familial de Scottish et British."
        />
        <meta property="og:image" content="/images/portee.jpg" />
        <meta property="og:url" content="https://www.janssensfamily.be/litter/{{ litter.id }}" />
        <meta property="og:type" content="website" />
    </Head>

    <Menu :title="capitalizeFirstLetter(litter?.name)" />
    <Layout>
        <div class="mx-auto w-full lg:mt-20 lg:py-6">
            <div :class="[{ 'bg-[#F4F4F4]': index % 2 === 1 }, 'justify-center py-10']">
                <div class="mx-auto flex w-full max-w-4xl flex-col gap-5 p-5 px-4 md:flex-row md:justify-center">
                    <DoubleCarrousel :cat="litter" />

                    <div class="relative mb-8 min-h-[350px] max-w-2xl shrink-0 grow basis-1/2 p-6 pl-10">
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

                        <!-- Information -->
                        <div class="flex min-h-0 w-full grow flex-col gap-3">
                            <h1 class="flex gap-2 text-3xl font-bold text-gray-900">
                                {{ capitalizeFirstLetter(litter.name) }}
                            </h1>
                            <p class="mb-5 flex items-center gap-2"><Cake /> Né le : {{ litter.birth_date }}</p>

                            <div class="z-10 flex h-full flex-col items-stretch gap-3 sm:flex-row">
                                <ParentCard :cat="litter.mother" parent="Maman" :index="0" class="h-full basis-1/2" />
                                <ParentCard :cat="litter.father" parent="Papa" :index="0" class="h-full basis-1/2" />
                            </div>
                            <div class="mb-6 rounded-lg bg-[#51687F] p-3 text-white">
                                <h2 class="mb-2 text-xl font-semibold">Description</h2>
                                <p class="leading-relaxed">{{ litter.description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="kittens.length">
                <h2 class="poetsone mb-6 px-4 text-center text-3xl text-[#B5A9A4]">Les chatons de cette portée</h2>

                <div class="m-3 my-6">
                    <ul class="mx-auto grid max-w-4xl grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3">
                        <li v-for="(kitten, index) in kittens" :key="index" class="w-full">
                            <CatCard :kitten="kitten" class="w-full" :isLiked="likes[kitten.id]" @toggle-like="handleLikeToggle" />
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </Layout>
</template>
