<script lang="ts" setup>
import { isKitten, isLitter } from '@/lib/utils';
import { Cat, Kitten, Litter } from '@/types';
import { Link } from '@inertiajs/vue3';
import Button from './Button.vue';

const props = defineProps<{
    kitten: Cat | Kitten | Litter;
    isLiked?: boolean;
}>();

const emit = defineEmits(['toggle-like']);

const toggleLike = () => {
    emit('toggle-like', props.kitten.id);
};
</script>

<template>
    <div class="group relative mx-auto max-w-md overflow-hidden rounded-lg shadow-lg transition-transform duration-300 hover:scale-105">
        <!-- Bandeau "Réservé" -->
        <div v-if="isKitten(kitten) && kitten.is_booked" class="absolute -top-10 -right-18 z-10 w-50 text-center">
            <div
                class="text-primary border-primary -translate-x-7 translate-y-20 rotate-45 transform bg-white px-2 py-1 text-center text-lg font-black uppercase shadow-md"
            >
                Réservé
            </div>
        </div>

        <div v-if="isKitten(kitten)" class="f absolute top-2 left-2 z-10" @click="toggleLike">
            <font-awesome-icon v-if="isLiked" icon="fa-solid fa-heart " class="z-10 text-2xl text-red-500" />
            <font-awesome-icon v-else icon="fa-regular fa-heart" class="text-primary z-10 text-2xl" />
        </div>

        <div v-if="isKitten(kitten) && kitten.is_adopted" class="absolute -top-10 -right-18 z-10 w-50 text-center">
            <div
                class="text-primary -translate-x-7 translate-y-20 rotate-45 transform bg-white px-2 py-1 text-center text-lg font-black uppercase shadow-md"
            >
                Adopté
            </div>
        </div>
        <div v-if="isLitter(kitten)" class="absolute -top-10 -right-18 z-10 w-50 text-center">
            <div
                class="text-primary -translate-x-7 translate-y-20 rotate-45 transform bg-white px-2 py-1 text-center text-lg font-black uppercase shadow-md"
            >
                {{ kitten.birth_date?.split('-')[0] }}
            </div>
        </div>

        <figure class="relative h-72 w-full overflow-hidden">
            <img
                loading="lazy"
                v-if="!isLitter(kitten) && kitten.images?.length"
                :src="(isKitten(kitten) && kitten.litter ? '/storage/kittens/' : '/storage/cats/') + kitten.images[0].image_path"
                :alt="'Photo de' + kitten.name"
                class="h-full w-full object-cover object-center transition-transform duration-500 group-hover:scale-110"
            />
            <img
                v-if="isLitter(kitten) && kitten.images?.length"
                :src="'/storage/litters/' + kitten.images[0].image_path"
                :alt="'Photo de' + kitten.name"
                class="h-full w-full object-cover object-center transition-transform duration-500 group-hover:scale-110"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
        </figure>
        <div class="absolute right-0 bottom-0 left-0 flex items-center justify-between p-4 text-white">
            <p class="poetsone text-xl">
                {{ kitten.name }}
                <span v-if="isKitten(kitten)">
                    <span class="ml-1 text-2xl font-bold" v-if="kitten.gender === 'Mâle'">♂</span>
                    <span class="ml-1 text-2xl font-bold" v-else>♀</span>
                </span>
            </p>
            <div v-if="!isLitter(kitten)" class="mt-2 flex justify-end">
                <Link v-if="isKitten(kitten)" :href="route('kitten.show', { id: kitten.id })">
                    <Button label="Voir plus" class="text-black" />
                </Link>
                <Link v-else :href="route('cats.show', { id: kitten.id })">
                    <Button label="Voir plus" class="text-black" />
                </Link>
            </div>
            <div v-if="isLitter(kitten)">
                <Link :href="route('litter.show', { id: kitten.id })">
                    <Button label="Voir plus" class="text-black" />
                </Link>
            </div>
        </div>
    </div>
</template>
