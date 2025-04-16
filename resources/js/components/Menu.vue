<script lang="ts" setup>
import { Link } from '@inertiajs/vue3';
import { motion } from 'motion-v'; // Assure-toi que c'est bien 'motion-v' ou le nom correct de la lib
import { ref } from 'vue';

const menuItems = [
    { name: 'Accueil', route: 'home' },
    { name: 'A propos', route: 'home' },
    { name: 'Nos chatons', route: 'kittens' },
    { name: 'Nos chat', route: 'kittens' },
    { name: "Conditions d'adoption", route: 'kittens' },
    { name: 'Contact', route: 'kittens' },
];

const isMenuOpen = ref(false);

const ulVariants = {
    hidden: {
        opacity: 0,
        x: -600,
        transition: {
            duration: 0.5,
            when: 'afterChildren',
            staggerChildren: 0.2,
            staggerDirection: -1,
        },
    },
    visible: {
        opacity: 1,
        x: 0,
        transition: {
            duration: 0.5,
            when: 'beforeChildren',
            staggerChildren: 0.2,
        },
    },
};

const liVariants = {
    hidden: {
        opacity: 0,
        x: -200,
    },
    visible: {
        opacity: 1,
        x: 0,
        transition: {
            delay: 0.4,

            duration: 0.7,
        },
    },
};
</script>

<template>
    <!-- Hamburger Button (inchangé) -->
    <div class="flex h-[80px] w-full justify-end p-3 md:hidden">
        <button @click="isMenuOpen = !isMenuOpen" class="fixed z-50 flex h-10 w-10 flex-col items-end justify-center gap-1" aria-label="Menu">
            <div
                class="absolute h-1 w-10 rounded-md bg-black transition-all duration-500"
                :class="{ 'translate-y-0 rotate-45': isMenuOpen, '-translate-y-2': !isMenuOpen }"
            ></div>
            <div class="absolute h-1 w-8 rounded-md bg-black transition-all duration-500" :class="{ 'opacity-0': isMenuOpen }"></div>
            <div
                class="absolute h-1 w-6 rounded-md transition-all duration-500"
                :class="{
                    'translate-y-0 -rotate-45': isMenuOpen,
                    'translate-y-2': !isMenuOpen,
                    'bg-[#B38D7D]': !isMenuOpen,
                }"
            ></div>
        </button>
    </div>

    <!-- Mobile Menu  -->
    <motion.ul
        class="fixed top-0 left-0 z-10 flex h-screen w-full flex-col justify-center gap-10 bg-white px-8 py-4 shadow-lg"
        :initial="'hidden'"
        :animate="isMenuOpen ? 'visible' : 'hidden'"
        :exit="'hidden'"
        :variants="ulVariants"
    >
        <motion.li v-for="(item, index) in menuItems" :key="item.route + '-' + index" class="overflow-hidden text-left" :variants="liVariants">
            <Link
                :href="route(item.route)"
                class="hover:text-primary block py-4 text-2xl font-black text-black transition-colors"
                @click="isMenuOpen = false"
            >
                {{ item.name }}
            </Link>
        </motion.li>
    </motion.ul>

    <!-- Desktop Menu (inchangé) -->
    <ul class="hidden space-x-4 md:flex">
        <Link
            v-for="(item, index) in menuItems"
            :key="item.route + '-desktop-' + index"
            :href="route(item.route)"
            class="hover:text-primary transform text-black transition-colors duration-200 hover:scale-105"
        >
            {{ item.name }}
        </Link>
    </ul>
</template>

<style></style>
