<script setup lang="ts">
import Button from '@/components/Button.vue';
import Footer from '@/components/Footer.vue';
import Menu from '@/components/Menu.vue';
import { Input } from '@/components/ui/input';
import Textarea from '@/components/ui/textarea/Textarea.vue';
import { getContentByTitle } from '@/lib/utils';
import { Link, useForm } from '@inertiajs/vue3';
import { motion } from 'motion-v';

defineProps<{
    contents?: any;
}>();

const draw2 = {
    hidden: { pathLength: 0, opacity: 0 },
    visible: (i) => {
        const delay = 0.8;
        return {
            pathLength: 1,
            opacity: 1,
            transition: {
                pathLength: { delay, type: 'spring', duration: 2, bounce: 0 },
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

const form = useForm({
    nom: '',
    prenom: '',
    email: '',
    telephone: '',
    message: '',
});

const submitForm = () => {
    form.post('/send-mail', {
        onSuccess: () => form.reset(),
    });
};
</script>
<template>
    <!-- SEO Meta Tags -->
    <head>
        <title>Janssens Family - Elevage familial de Scottish & British</title>
        <meta
            name="description"
            content="Découvrez l'élevage familial Janssens Family spécialisé dans les chats Scottish et British. Contactez-nous pour en savoir plus sur nos reproducteurs et chatons."
        />
        <meta name="keywords" content="élevage familial, Scottish, Fold, British, chats, chatons, reproducteurs, Janssens Family" />
        <meta name="author" content="Janssens Family" />
    </head>

    <!-- Menu -->
    <Menu />

    <!-- header -->
    <header class="h-70vh border-primary relative flex flex-col items-center justify-between overflow-hidden border-b-2 md:flex-row-reverse lg:mt-20">
        <div class="z-10 basis-1/3 flex-col items-center gap-5 overflow-hidden text-end md:static md:mr-20 md:flex">
            <motion.h1
                :initial="{ opacity: 0, y: -50 }"
                :animate="{ opacity: 1, y: 0, transition: { duration: 0.5, ease: 'easeInOut' } }"
                class="mb-5 text-5xl font-black text-[#A28C83] md:text-6xl lg:text-8xl"
            >
                Janssens <br />
                Family
            </motion.h1>
            <motion.h2
                :initial="{ opacity: 0, y: -50 }"
                :animate="{ opacity: 1, y: 0, transition: { duration: 0.5, ease: 'easeInOut' } }"
                class="relative text-[20px] font-bold text-[#CDC6C2] lg:text-4xl"
                ><strong>Elevage familial de <br />Scottish & British </strong></motion.h2
            >
        </div>
        <div class="flex w-3/4 self-start md:basis-1/3">
            <motion.img
                src="urban.jpeg"
                alt="Photo de Urban, British short hair black silver tabby"
                class="relative self-start"
                :initial="{ opacity: 0, x: -5 }"
                :animate="{ opacity: 1, x: 0, transition: { duration: 2, delay: 0.2, ease: 'easeInOut' } }"
            />
            <div>
                <motion.svg
                    width="100"
                    height="230"
                    initial="hidden"
                    animate="visible"
                    class="relative top-20 -left-18 shrink-0 scale-50 md:top-30 md:scale-100"
                >
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
                    :animate="{ opacity: 1, y: 0, transition: { duration: 1, delay: 0.3, ease: 'easeInOut' } }"
                    class="grapenuts relative -top-15 left-2 text-lg font-bold text-[#51687F] md:left-8 md:text-[27px]"
                    >Voici <br />Urban</motion.p
                >
            </div>
        </div>
        <!-- <div class="absolute bottom-0 flex w-full flex-col items-center justify-center gap-3 p-3 md:hidden">
            <p class="grapenuts relative text-2xl text-[#B5A9A4]">Scroll pour nous découvrir</p>
            <div class="rounded-full p-3 backdrop-blur-md"><ArrowUp class="text-primary relative -top-1 rotate-180 animate-bounce" /></div>
            <div class="w-full rounded-lg bg-gradient-to-b from-stone-400 to-stone-50 p-[2px]"></div>
        </div> -->
    </header>

    <div class="mx-3">
        <!-- Qui somme-nous -->
        <motion.section
            class="bg-tertiary z-40 mx-auto my-20 flex max-w-3xl flex-col rounded-xl p-5"
            :initial="{ opacity: 0, x: -20 }"
            :in-view="{ opacity: 1, x: 0, transition: { duration: 1, delay: 0 } }"
            :viewport="{ once: true }"
        >
            <h3 class="poetsone mb-3 text-3xl text-[#B5A9A4]">Qui sommes-nous ?</h3>
            <p class="text-justify text-white" v-html="getContentByTitle('Qui sommes-nous ?', contents)"></p>
            <Link :href="route('elevage')" class="mt-3 self-end">
                <Button label="Découvrir" />
            </Link>
        </motion.section>

        <!-- Nos chats -->
        <section class="m-3 mx-auto my-40 max-w-3xl overflow-hidden">
            <h3 class="text-primary poetsone mb-3 text-3xl">Nos chats</h3>
            <ul class="flex gap-3">
                <motion.li
                    class="border-primary flex basis-1/2 flex-col justify-end rounded-bl-xl border-b-2 border-l-2 p-3"
                    :initial="{ opacity: 0, x: -30 }"
                    :in-view="{ opacity: 1, x: 0, transition: { duration: 1, delay: 0 } }"
                    :viewport="{ once: true }"
                >
                    <img src="reproducteurs.png" alt="Nos reproducteurs Scottish et British" class="w-10/12 rounded-lg" />
                    <h4 class="poetsone mb-3 text-center text-lg">Nos reproducteurs</h4>
                    <Link :href="route('cats')" class="self-center">
                        <Button label="Découvrir" />
                    </Link>
                </motion.li>
                <motion.li
                    class="border-primary flex basis-1/2 flex-col justify-end rounded-tr-xl border-t-2 border-r-2 border-b-2 border-b-transparent p-3"
                    :initial="{ opacity: 0, x: 30 }"
                    :in-view="{ opacity: 1, x: 0, transition: { duration: 1, delay: 0 } }"
                    :viewport="{ once: true }"
                >
                    <img src="chatons.png" alt="Nos chatons Scottish et British" class="relative top-7 rounded-lg" />
                    <h4 class="poetsone mb-3 text-center text-lg">Nos chatons</h4>
                    <Link :href="route('kittens')" class="self-center">
                        <Button label="Découvrir" />
                    </Link>
                </motion.li>
            </ul>
        </section>

        <!-- Contacter nous -->
        <motion.form
            @submit.prevent="submitForm"
            id="contact"
            :initial="{ opacity: 0, x: -20 }"
            :in-view="{ opacity: 1, x: 0, transition: { duration: 1, delay: 0 } }"
            :viewport="{ once: true }"
        >
            <section class="m-3 mx-auto mt-40 flex max-w-3xl flex-col gap-3 rounded-xl bg-[#ABA5A2] p-5">
                <h3 class="poetsone mb-3 text-3xl text-white">Contactez-nous</h3>
                <div>
                    <Input v-model="form.nom" type="text" placeholder="Nom" class="rounded-lg bg-white text-black" />
                    <p v-if="form.errors.nom" class="text-sm text-red-500">{{ form.errors.nom }}</p>
                </div>
                <div>
                    <Input v-model="form.prenom" type="text" placeholder="Prénom" class="rounded-lg bg-white text-black" />
                    <p v-if="form.errors.prenom" class="text-sm text-red-500">{{ form.errors.prenom }}</p>
                </div>
                <div>
                    <Input v-model="form.email" type="email" placeholder="Email" class="rounded-lg bg-white text-black" />
                    <p v-if="form.errors.email" class="text-sm text-red-500">{{ form.errors.email }}</p>
                </div>
                <div>
                    <Input v-model="form.telephone" type="text" placeholder="Téléphone" class="rounded-lg bg-white text-black" />
                    <p v-if="form.errors.telephone" class="text-sm text-red-500">{{ form.errors.telephone }}</p>
                </div>
                <div>
                    <Textarea
                        v-model="form.message"
                        placeholder="Message"
                        class="h-32 resize-none rounded-lg bg-white text-black"
                        rows="4"
                    ></Textarea>
                    <p v-if="form.errors.message" class="text-sm text-red-500">{{ form.errors.message }}</p>
                </div>

                <Button type="submit" label="Envoyer" class="self-end" :disabled="form.processing" />
            </section>
        </motion.form>
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
