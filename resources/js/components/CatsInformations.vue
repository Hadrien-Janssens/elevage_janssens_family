<script lang="ts" setup>
import { capitalizeFirstLetter, isKitten } from '@/lib/utils';
import { Cat, Kitten } from '@/types';
import { Link } from '@inertiajs/vue3';
import { Cake, HeartCrack } from 'lucide-vue-next';
import ParentCard from './ParentCard.vue';

const props = defineProps<{
    kitten: Kitten | Cat;
    index: number; // savoir si c'est pair ou impair pour l'affichage 0|1
    isLiked?: boolean;
}>();

const emit = defineEmits(['toggle-like']);

const toggleLike = () => {
    emit('toggle-like', props.kitten.id);
};
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

        <div class="mb-6 flex w-full flex-col justify-between gap-4">
            <div>
                <div class="flex w-full flex-col items-start justify-between gap-3 md:flex-row">
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
                    <div v-if="isKitten(kitten)" class="text-right">
                        <div v-if="!kitten.is_booked" class="text-primary flex items-center gap-2" @click="toggleLike">
                            <font-awesome-icon v-if="isLiked" icon="fa-solid fa-heart " class="z-10 text-lg text-red-500" />
                            <font-awesome-icon v-else icon="fa-regular fa-heart" class="z-10 text-lg text-red-500" />
                            <span class="font-medium">Disponible pour adoption</span>
                        </div>
                        <div v-else class="text-primary flex items-center gap-2">
                            <HeartCrack class="h-5 w-5 text-red-500" />
                            <span class="font-medium">Ce chaton est réservé</span>
                        </div>
                    </div>
                </div>
                <p class="mt-1 flex items-center gap-2 text-gray-600">
                    <Cake class="h-5 w-5 text-[#51687F]" />
                    <span v-if="isKitten(kitten)">Né le {{ kitten.litter.birth_date }}</span>
                    <span v-else>Né le {{ kitten.birthday }}</span>
                </p>
                <p class="leading-relaxed text-gray-700">Sexe : {{ kitten.gender }}</p>
                <p class="leading-relaxed text-gray-700">Race : {{ kitten.race }}</p>
                <p class="leading-relaxed text-gray-700">Couleur : {{ kitten.body_color }}</p>
                <p v-if="isKitten(kitten) && !kitten.is_adopted" class="leading-relaxed text-gray-700">Prix : {{ kitten.price }}€</p>
            </div>
        </div>

        <div class="mb-5 flex flex-col justify-between gap-3 sm:flex-row" v-if="isKitten(kitten) && kitten.litter">
            <Link :href="route('cats.show', { id: kitten.litter.mother.id })" class="grow basis-1/2">
                <ParentCard :cat="kitten.litter.mother" parent="Maman" :index="index" />
            </Link>
            <Link :href="route('cats.show', { id: kitten.litter.father.id })" class="grow basis-1/2">
                <ParentCard :cat="kitten.litter.father" parent="Papa" :index="index" />
            </Link>
        </div>

        <div class="mb-6 rounded-lg bg-[#51687F] p-3 text-white">
            <h2 class="mb-2 text-xl font-semibold">Description</h2>
            <p class="leading-relaxed">{{ kitten.description }}</p>
        </div>
    </div>
</template>
