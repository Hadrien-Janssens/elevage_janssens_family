<script lang="ts" setup>
import { Link } from '@inertiajs/vue3';
import { ArrowLeft } from 'lucide-vue-next';
import { motion } from 'motion-v';
import { ref } from 'vue';
import { route } from '../../../vendor/tightenco/ziggy/src/js/index';

defineProps({
    title: {
        type: String,
        required: false,
    },
});

const menuItems = [
    { name: 'Accueil', route: 'home' },
    { name: 'A propos', route: 'elevage' },
    { name: 'Nos chatons', route: 'kittens' },
    { name: 'Nos chat', route: 'cats' },
    { name: "Conditions d'adoption", route: 'booking' },
];

const isMenuOpen = ref(false);

const ulVariants = {
    hidden: {
        opacity: 0,
        x: 0,
        pointerEvents: 'none',
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
        pointerEvents: 'auto',
        transition: {
            duration: 0.5,
            when: 'beforeChildren',
            staggerChildren: 0.1,
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

            duration: 0.5,
        },
    },
};

const goBack = () => {
    window.history.back();
};
</script>

<template>
    <!-- Hamburger Button -->
    <div
        class="sticky top-0 z-[9999] flex h-[80px] w-full items-start p-3 backdrop-blur-lg lg:hidden"
        :class="{ 'justify-between': title, 'justify-end': !title }"
    >
        <button v-if="title" @click="goBack" class="duration-300 hover:scale-125 hover:cursor-pointer" aria-label="retour">
            <ArrowLeft class="scale-110 text-[#51687F]" />
        </button>
        <h1 v-if="title" class="text-[#51687F]">{{ title }}</h1>

        <button
            @click="isMenuOpen = !isMenuOpen"
            class="group relative z-50 flex h-10 w-10 translate-y-2 flex-col items-end gap-1 hover:cursor-pointer"
            aria-label="Menu"
        >
            <div
                class="absolute h-1 w-10 rounded-md bg-[#51687F] transition-all duration-500"
                :class="{ 'translate-y-0 rotate-45': isMenuOpen, '-translate-y-2': !isMenuOpen }"
            ></div>
            <div
                class="absolute h-1 w-8 rounded-md bg-[#51687F] transition-all duration-500 group-hover:w-10"
                :class="{ 'opacity-0': isMenuOpen }"
            ></div>
            <div
                class="absolute h-1 rounded-md transition-all duration-500 group-hover:w-10"
                :class="{
                    'top-0 w-10 translate-y-0 -rotate-45 bg-[#51687F]': isMenuOpen,
                    'w-6 translate-y-2': !isMenuOpen,
                    'bg-[#B38D7D]': !isMenuOpen,
                }"
            ></div>
        </button>
    </div>

    <!-- Mobile Menu  -->
    <motion.ul
        class="fixed top-0 left-0 z-[999] flex h-screen w-full flex-col justify-center gap-7 bg-white px-8 py-4 shadow-lg"
        :initial="'hidden'"
        :animate="isMenuOpen ? 'visible' : 'hidden'"
        :exit="'hidden'"
        :variants="ulVariants"
    >
        <motion.li v-for="(item, index) in menuItems" :key="item.route + '-' + index" class="overflow-hidden text-left" :variants="liVariants">
            <Link
                :href="route(item.route)"
                :class="[
                    'text-primary poetsone block py-4 text-xl font-black transition-colors duration-400 hover:text-[#51687F]',
                    route().current(item.route + '*') ? 'underline' : '',
                ]"
                @click="isMenuOpen = false"
            >
                {{ item.name }}
            </Link>
        </motion.li>
        <motion.li class="overflow-hidden text-left" :variants="liVariants">
            <Link
                :href="route('home') + '#contact'"
                :class="[
                    'text-primary poetsone block py-4 text-xl font-black transition-colors duration-400 hover:text-[#51687F]',
                    route().current('home#contact') ? 'underline' : '',
                ]"
                @click="isMenuOpen = false"
            >
                Contact
            </Link>
        </motion.li>
    </motion.ul>

    <!-- Desktop Menu -->
    <div class="fixed top-0 right-0 z-[999] mb-5 hidden w-full justify-between gap-10 px-5 pt-2 text-lg backdrop-blur-lg lg:flex">
        <Link
            :href="route('home')"
            class="poetsone text-primary hidden transform transition-colors duration-400 hover:scale-[101%] hover:cursor-pointer md:block"
        >
            <img src="img/logo.jpeg" alt="" class="w-20 rounded-full" />
        </Link>
        <ul class="hidden justify-end space-x-4 md:flex">
            <Link
                v-for="(item, index) in menuItems"
                :key="item.route + '-desktop-' + index"
                :href="route(item.route)"
                :class="[
                    'poetsone text-primary transform transition-colors duration-400 hover:scale-[101%] hover:text-[#51687F]',
                    route().current(item.route + '*') ? 'underline' : '',
                ]"
            >
                {{ item.name }}
            </Link>
            <Link
                :href="route('home') + '#contact'"
                :class="[
                    'poetsone text-primary transform transition-colors duration-400 hover:scale-[101%] hover:text-[#51687F]',
                    route().current('home#contact') ? 'underline' : '',
                ]"
            >
                Contact
            </Link>
        </ul>
    </div>
</template>
