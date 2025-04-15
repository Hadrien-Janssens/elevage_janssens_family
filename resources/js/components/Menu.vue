<script lang="ts" setup>
import { Link } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const menuItems = [
    { name: 'Accueil', route: 'home' },
    { name: 'Nos chatons', route: 'kittens' },
];

const isMenuOpen = ref(false);
const itemDelays = ref(menuItems.map(() => false));

const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value;

    // Réinitialiser les animations quand le menu se ferme
    if (!isMenuOpen.value) {
        itemDelays.value = menuItems.map(() => false);
    }
};

watch(isMenuOpen, (newVal) => {
    if (newVal) {
        // Activer les animations un par un avec un délai
        menuItems.forEach((_, index) => {
            setTimeout(() => {
                itemDelays.value[index] = true;
            }, index * 150);
        });
    }
});
</script>

<template>
    <!-- Hamburger Button -->
    <div class="flex h-[80px] w-full justify-end p-3 md:hidden">
        <button @click="toggleMenu" class="relative flex h-10 w-10 flex-col items-end justify-center gap-1" aria-label="Menu">
            <div
                class="absolute h-1 w-10 rounded-md bg-black transition-all duration-300"
                :class="{ 'translate-y-0 rotate-45': isMenuOpen, '-translate-y-2': !isMenuOpen }"
            ></div>
            <div class="absolute h-1 w-8 rounded-md bg-black transition-all duration-300" :class="{ 'opacity-0': isMenuOpen }"></div>
            <div
                class="absolute h-1 w-6 rounded-md bg-black transition-all duration-300"
                :class="{
                    'translate-y-0 -rotate-45': isMenuOpen,
                    'translate-y-2': !isMenuOpen,
                    'bg-primary': !isMenuOpen,
                }"
            ></div>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div v-show="isMenuOpen" class="fixed inset-0 z-50 bg-white md:hidden">
        <div class="flex h-full flex-col">
            <div class="flex justify-end p-6">
                <button @click="toggleMenu" class="text-2xl font-bold text-black" aria-label="Fermer le menu">✕</button>
            </div>
            <nav class="flex-1">
                <ul class="flex flex-col px-8 py-4">
                    <li v-for="(item, index) in menuItems" :key="item.route" class="overflow-hidden border-b border-gray-100">
                        <Link
                            :href="route(item.route)"
                            class="hover:text-primary block py-4 text-xl font-medium text-black transition-colors"
                            @click="toggleMenu"
                            :style="{
                                'transition-delay': `${index * 0.1}s`,
                                transform: itemDelays[index] ? 'translateX(0)' : 'translateX(-100%)',
                                opacity: itemDelays[index] ? '1' : '0',
                                transition: 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)',
                            }"
                        >
                            {{ item.name }}
                        </Link>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Desktop Menu -->
    <ul class="hidden space-x-4 md:flex">
        <Link
            v-for="item in menuItems"
            :key="item.route"
            :href="route(item.route)"
            class="hover:text-primary transform text-black transition-colors duration-200 hover:scale-105"
        >
            {{ item.name }}
        </Link>
    </ul>
</template>
