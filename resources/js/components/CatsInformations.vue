<script lang="ts" setup>
import { capitalizeFirstLetter, isKitten } from '@/lib/utils';
import { Cat, Kitten } from '@/types';
import { Link } from '@inertiajs/vue3';
import { Cake, Heart, HeartCrack } from 'lucide-vue-next';
import ParentCard from './ParentCard.vue';

defineProps<{
    kitten: Kitten | Cat;
    index: number; // savoir si c'est pair ou impair pour l'affichage 0|1
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
                    <div v-if="kitten.gender !== 'Indéfini'">
                        <svg
                            v-if="kitten.gender === 'Mâle'"
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="4"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="lucide lucide-mars-icon lucide-mars"
                        >
                            <path d="M16 3h5v5" />
                            <path d="m21 3-6.75 6.75" />
                            <circle cx="10" cy="14" r="6" />
                        </svg>
                        <svg
                            v-else
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="4"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="lucide lucide-venus-icon lucide-venus"
                        >
                            <path d="M12 15v7" />
                            <path d="M9 19h6" />
                            <circle cx="12" cy="9" r="6" />
                        </svg>
                    </div>
                </h1>
                <p class="mt-1 flex items-center gap-2 text-gray-600">
                    <Cake class="h-5 w-5 text-[#51687F]" />
                    <span v-if="isKitten(kitten)">Né le {{ kitten.litter.birth_date }}</span>
                    <span v-else>Né le {{ kitten.birthday }}</span>
                </p>
            </div>
            <p class="leading-relaxed text-gray-700">Sexe : {{ kitten.gender }}</p>
        </div>

        <div class="mb-6">
            <h2 class="mb-2 text-xl font-semibold text-gray-900">Description</h2>
            <p class="leading-relaxed text-gray-700">{{ kitten.description }}</p>
        </div>

        <div class="mb-5 flex gap-3" v-if="isKitten(kitten) && kitten.litter">
            <Link :href="route('cats.show', { id: kitten.litter.mother.id })">
                <ParentCard :name="kitten.litter.mother.name" parent="Maman" :index="index" />
            </Link>
            <Link :href="route('cats.show', { id: kitten.litter.father.id })">
                <ParentCard :name="kitten.litter.father.name" parent="Papa" :index="index" />
            </Link>
        </div>

        <div v-if="isKitten(kitten)">
            <p>Status</p>
            <div v-if="!kitten.is_booked" class="text-primary flex items-center gap-2">
                <Heart class="h-5 w-5 text-red-500" />
                <span class="font-medium">Disponible pour adoption</span>
            </div>
            <div v-else class="text-primary flex items-center gap-2">
                <HeartCrack class="h-5 w-5 text-red-500" />
                <span class="font-medium">Ce chaton est réservé</span>
            </div>
            <p>Prix : {{ kitten.price }}€</p>
        </div>
    </div>
</template>
