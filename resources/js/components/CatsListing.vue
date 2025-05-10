<script lang="ts" setup>
import { motion } from 'motion-v';
import { Kitten } from '../types/index';
import CatCard from './CatCard.vue';
import CatsInformations from './CatsInformations.vue';
import DoubleCarrousel from './DoubleCarrousel.vue';

defineProps<{
    kittens: Kitten[];
}>();

// Configurations d'animation simplifiées et corrigées
const cardAnimation = {
    initial: { opacity: 0, x: 70 },
    inView: {
        opacity: 1,
        x: 0,
        transition: {
            duration: 1,
            ease: [0.215, 0.61, 0.355, 1],
        },
    },
    hover: {
        scale: 1.05,
        transition: { duration: 0.3 },
    },
};

const containerAnimation = {
    initial: { opacity: 0 },
    inView: {
        opacity: 1,
        transition: {
            staggerChildren: 0.1,
            when: 'beforeChildren',
        },
    },
};

const desktopItemAnimation = {
    initial: { opacity: 0, y: 20 },
    inView: {
        opacity: 1,
        y: 0,
        transition: {
            duration: 0.8,
            ease: [0.215, 0.61, 0.355, 1],
        },
    },
};
</script>

<template>
    <!-- Version mobile -->
    <motion.div
        v-if="kittens.length > 0"
        class="m-4 grid grid-cols-1 gap-6 md:hidden md:grid-cols-2"
        :initial="containerAnimation.initial"
        :in-view="containerAnimation.inView"
        :viewport="{ once: true, margin: '-20%' }"
    >
        <motion.div
            v-for="(kitten, index) in kittens"
            :key="index"
            :initial="cardAnimation.initial"
            :in-view="cardAnimation.inView"
            :while-hover="cardAnimation.hover"
            :viewport="{ once: true }"
            :transition="{ delay: index * 0.1 }"
        >
            <CatCard :kitten="kitten" class="group relative overflow-hidden rounded-lg shadow-lg transition-transform duration-300" />
        </motion.div>
    </motion.div>

    <motion.p
        v-else
        class="poetsone px-4 text-center text-xl text-[#B5A9A4]"
        :initial="{ opacity: 0 }"
        :in-view="{ opacity: 1, transition: { delay: 0.5 } }"
        :viewport="{ once: true }"
    >
        Aucun chaton disponible à l'adoption pour le moment.
    </motion.p>

    <!-- Version desktop -->
    <motion.div
        v-for="(kitten, index) in kittens"
        :key="index"
        :class="[{ 'bg-[#F4F4F4]': index % 2 === 1 }, 'hidden justify-center py-10 md:flex']"
        :initial="{ opacity: 0 }"
        :in-view="{ opacity: 1 }"
        :viewport="{ once: true, margin: '-10%' }"
    >
        <motion.div
            class="hidden w-full max-w-4xl items-start gap-5 p-5 px-4 md:flex md:justify-center"
            :class="[{ 'md:flex-row-reverse': index % 2 === 1 }]"
            :initial="desktopItemAnimation.initial"
            :in-view="desktopItemAnimation.inView"
            :viewport="{ once: true }"
        >
            <motion.div
                :initial="{ opacity: 0, x: index % 2 === 0 ? -50 : 50 }"
                :in-view="{ opacity: 1, x: 0, transition: { duration: 0.8, delay: 0.2 } }"
                :viewport="{ once: true }"
            >
                <DoubleCarrousel :cat="kitten" />
            </motion.div>

            <motion.div
                :initial="{ opacity: 0, y: 30 }"
                :in-view="{ opacity: 1, y: 0, transition: { duration: 0.8, delay: 0.4 } }"
                :viewport="{ once: true }"
            >
                <CatsInformations :kitten="kitten" :index="index" />
            </motion.div>
        </motion.div>
    </motion.div>
</template>
