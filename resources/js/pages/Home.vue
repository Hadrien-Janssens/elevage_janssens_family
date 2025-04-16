<script setup lang="ts">
import Button from '@/components/Button.vue';
import Footer from '@/components/Footer.vue';
import Menu from '@/components/Menu.vue';
import { Input } from '@/components/ui/input';
import { Link } from '@inertiajs/vue3';
import { ArrowUp } from 'lucide-vue-next';
import { motion } from 'motion-v';

const draw = {
    hidden: { pathLength: 0, pathOffset: 1, opacity: 0 },
    visible: (i) => {
        const delay = 1;
        return {
            pathLength: 1,
            pathOffset: 0,
            opacity: 1,
            transition: {
                pathLength: { delay, type: 'spring', duration: 3, bounce: 0 },
                opacity: { delay, duration: 0.01 },
            },
        };
    },
};
const draw2 = {
    hidden: { pathLength: 0, opacity: 0 },
    visible: (i) => {
        const delay = 1.4;
        return {
            pathLength: 1,
            opacity: 1,
            transition: {
                pathLength: { delay, type: 'spring', duration: 3, bounce: 0 },
                opacity: { delay, duration: 0.8 },
            },
        };
    },
};

const shape = {
    strokeWidth: 2,
    strokeLinecap: 'round',
    fill: 'transparent',
};
</script>
<template>
    <!-- Menu -->
    <Menu />

    <!-- header -->
    <header class="h-90vh flex flex-col items-center justify-end">
        <div class="h-[40px]"></div>

        <div class="flex w-full justify-end gap-10">
            <motion.p
                :initial="{ opacity: 0, y: -50 }"
                :animate="{ opacity: 1, y: 0, transition: { duration: 1.5, delay: 1, ease: 'easeInOut' } }"
                class="grapenuts relative -top-7 left-18 text-[27px] font-bold text-[#51687F]"
                >Voici Una</motion.p
            >
            <motion.svg width="81" height="67" initial="hidden" animate="visible" class="relative top-10 shrink-0">
                <motion.path
                    d="M79.517 51.0104C44.1928 57.0555 25.5319 73.9356 1.25493 16.6453"
                    stroke="#51687F"
                    :variants="draw"
                    :custom="1"
                    :style="shape"
                />
                <motion.path
                    d="M65.1941 47.7607C69.2109 50.7523 72.6697 51.1404 80.0182 50.5724C72.3852 54.4432 69.6332 56.7303 70.8563 61.2791"
                    stroke="#51687F"
                    :variants="draw"
                    :custom="1"
                    :style="shape"
                />
            </motion.svg>
            <motion.img
                :initial="{ opacity: 0, x: -5 }"
                :animate="{ opacity: 1, x: 0, transition: { duration: 3, delay: 0.2, ease: 'easeInOut' } }"
                src="una.png"
                alt=""
                class="mb-10 w-7/12 self-end"
            />
        </div>
        <motion.h1
            :initial="{ opacity: 0, y: -50 }"
            :animate="{ opacity: 1, y: 0, transition: { duration: 0.5, ease: 'easeInOut' } }"
            class="mb-5 text-5xl font-black text-[#A28C83]"
        >
            Janssens <br />
            Family
        </motion.h1>
        <motion.h2
            :initial="{ opacity: 0, y: -50 }"
            :animate="{ opacity: 1, y: 0, transition: { duration: 0.5, ease: 'easeInOut' } }"
            class="relative left-10 text-[20px] font-bold text-[#CDC6C2]"
            >Elevage familial de <br />Scottish & British</motion.h2
        >
        <div class="flex">
            <motion.img
                src="urban.jpeg"
                alt="british short hair black silver tabby"
                class="relative right-10 w-7/12 self-start"
                :initial="{ opacity: 0, x: -5 }"
                :animate="{ opacity: 1, x: 0, transition: { duration: 3, delay: 0.2, ease: 'easeInOut' } }"
            />
            <div>
                <motion.svg width="100" height="230" initial="hidden" animate="visible" class="relative top-30 -left-20 shrink-0">
                    <motion.path
                        d="M0.636612 56.5936C28.6066 61.1496 45.2277 59.9822 72.468 51.4976C81.9355 47.6357 88.8481 42.4366 87.0745 33.0211C82.4398 23.8058 75.8702 19.8909 67.1079 27.668C56.6037 38.157 58.593 45.5176 64.886 56.637C73.7743 78.4658 94.9691 91.4813 96.0136 87.8093"
                        stroke="#51687F"
                        :variants="draw2"
                        :custom="1"
                        :style="shape"
                    />
                    <motion.path
                        d="M17.3706 51.0701C12.6822 54.9791 8.94559 55.9582 1.19808 56.5193C8.79496 59.5155 11.4115 61.5683 9.48418 66.7272"
                        stroke="#51687F"
                        :variants="draw2"
                        :custom="1"
                        :style="shape"
                    />
                </motion.svg>
                <motion.p
                    :initial="{ opacity: 0, y: -50 }"
                    :animate="{ opacity: 1, y: 0, transition: { duration: 1.5, delay: 1, ease: 'easeInOut' } }"
                    class="grapenuts relative -top-15 left-8 text-[27px] font-bold text-[#51687F]"
                    >Voici <br />Urban</motion.p
                >
            </div>
        </div>
        <p class="grapenuts relative text-2xl text-[#B5A9A4]">Scroll pour nous découvrir</p>
        <div class="mb-3 rounded-full bg-[#CDC6C2] p-3"><ArrowUp class="relative -top-1 rotate-180 animate-bounce text-white" /></div>
        <div class="w-full rounded-lg bg-gradient-to-b from-stone-400 to-stone-50 p-[2px]"></div>
    </header>

    <!-- Qui somme-nous -->
    <div class="bg-tertiary z-40 m-3 mt-10 flex flex-col gap-3 rounded-xl p-5">
        <h3 class="poetsone text-3xl text-[#B5A9A4]">Qui sommes-nous ?</h3>
        <p class="text-justify text-white">
            Nous sommes un élevage familial où passion, dévouement et amour des félins font partie intégrante de nos valeurs. Un foyer chaleureux où
            les chats grandissent heureux et équilibrés, prêts à devenir le compagnon idéal pour votre famille. Avec un attachement particulier pour
            les Scottish et les British, c’est tout naturellement que nous nous sommes tourné vers cette race pour nous élevage
        </p>
        <Link :href="route('elevage')" class="self-end">
            <Button label="Découvrir" />
        </Link>
    </div>

    <!-- Nos chats -->
    <div class="m-3 mt-10">
        <h3 class="text-primary poetsone mb-3 text-3xl">Nos chats</h3>
        <ul class="flex gap-3">
            <li class="border-primary flex basis-1/2 flex-col justify-end rounded-bl-xl border-b-2 border-l-2 p-3">
                <img src="reproducteurs.png" alt="chat1" class="w-10/12 rounded-lg" />
                <h4 class="poetsone mb-3 text-center text-lg">Nos reproducteurs</h4>
                <Link :href="route('cats')" class="self-center">
                    <Button label="Découvrir" />
                </Link>
            </li>
            <li class="border-primary flex basis-1/2 flex-col justify-end rounded-tr-xl border-t-2 border-r-2 border-b-2 border-b-transparent p-3">
                <img src="chatons.png" alt="chat1" class="relative top-7 rounded-lg" />
                <h4 class="poetsone mb-3 text-center text-lg">Nos chatons</h4>
                <Link :href="route('kittens')" class="self-center">
                    <Button label="Découvrir" />
                </Link>
            </li>
        </ul>
    </div>

    <!-- Contacter nous -->
    <!-- Qui somme-nous -->
    <div class="m-3 mt-10 flex flex-col gap-3 rounded-xl bg-[#ABA5A2] p-5" id="contact">
        <h3 class="poetsone mb-3 text-3xl text-white">Contactez-nous</h3>
        <Input type="text" placeholder="Nom" class="rounded-lg bg-white text-black" />
        <Input type="text" placeholder="Prénom" class="rounded-lg bg-white text-black" />
        <Input type="email" placeholder="Email" class="rounded-lg bg-white text-black" />
        <Input type="text" placeholder="Téléphone" class="rounded-lg bg-white text-black" />
        <Input type="text" placeholder="Message" class="rounded-lg bg-white text-black" />
        <Button label="Envoyer" class="self-end" />
    </div>

    <Footer />
</template>

<style scoped>
h1,
.poetsone {
    font-family: poetsen-one;
}
.grapenuts {
    font-family: grapenuts;
}
p,
.koho {
    font-family: koho;
}
</style>
