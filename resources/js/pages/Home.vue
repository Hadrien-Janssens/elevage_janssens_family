<script setup lang="ts">
import Button from '@/components/Button.vue';
import Menu from '@/components/Menu.vue';
import { Input } from '@/components/ui/input';
import Textarea from '@/components/ui/textarea/Textarea.vue';
import { getContentByTitle } from '@/lib/utils';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { motion } from 'motion-v';
import { toast, Toaster } from 'vue-sonner';
import Layout from './Layout.vue';

defineProps<{
    contents?: any;
}>();

const draw2 = {
    hidden: { pathLength: 0, opacity: 0 },
    visible: () => {
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
        preserveScroll: true,
        onSuccess: () => {
            form.reset();

            toast('✅ Votre email a bien été envoyé;', {
                description: 'Nous vous répondrons dans les plus brefs délais.',
                duration: 5000,
                closeButton: true,
            });
        },
    });
};
</script>
<template>
    <!-- SEO Meta Tags -->
    <Head title="Chatterie des petits plis- Elevage familial de Scottish & British">
        <meta
            name="description"
            content="Découvrez la chatterie des petits plis, spécialisé dans l'élevage de Scottish et British shortair. Contactez-nous pour en savoir plus sur nos reproducteurs et chatons."
        />
        <meta name="keywords" content="élevage familial, Scottish, Fold, British, chats, chatons, reproducteurs, Janssens Family" />
        <meta name="author" content="Chatterie des petits plis" />
        <meta property="og:type" content="website" />
    </Head>

    <!-- Menu -->
    <Menu />

    <Layout>
        <Toaster class="pointer-events-auto" />

        <!-- header -->

        <header
            class="h-70vh border-primary relative flex flex-col items-center justify-between overflow-hidden border-b-2 md:flex-row-reverse lg:mt-20"
        >
            <div class="z-10 basis-1/3 flex-col items-center gap-5 text-end md:static md:mr-32 md:flex">
                <motion.h2
                    as="h2"
                    :initial="{ opacity: 0, y: -50 }"
                    :animate="{ opacity: 1, y: 0, transition: { duration: 0.5, ease: 'easeInOut' } }"
                    class="text-primary poetsone mb-5 text-5xl font-black xl:text-7xl"
                    aria-label="Janssens Family - Elevage familial de Scottish et British"
                >
                    Chatterie des <br />
                    Petits Plis
                </motion.h2>
                <motion.h1
                    as="h1"
                    :initial="{ opacity: 0, y: -50 }"
                    :animate="{ opacity: 1, y: 0, transition: { duration: 0.5, ease: 'easeInOut' } }"
                    class="relative text-[20px] font-bold text-[#A28C83] lg:text-4xl"
                    >Elevage familial de <br /><strong>Scottish & British</strong>
                </motion.h1>
            </div>
            <div class="flex w-3/4 self-start md:basis-1/3">
                <motion.img
                    src="img/urban.webp"
                    alt=""
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
        </header>

        <main class="mx-3">
            <!-- Qui somme-nous -->
            <motion.section
                as="section"
                class="bg-tertiary z-40 mx-auto my-20 flex max-w-3xl flex-col rounded-xl p-5"
                :initial="{ opacity: 0, y: 20 }"
                :in-view="{ opacity: 1, y: 0, transition: { duration: 1, delay: 0 } }"
                :viewport="{ once: true }"
                aria-labelledby="qui-sommes-nous"
            >
                <h3 id="qui-sommes-nous" class="poetsone mb-3 text-3xl text-[#B5A9A4]">Qui sommes-nous ?</h3>
                <p class="text-justify text-white" v-if="contents" v-html="getContentByTitle('Qui sommes-nous ?', contents)"></p>
                <Link :href="route('elevage')" class="mt-3 self-end" aria-label="Découvrir notre élevage">
                    <Button label="Découvrir" />
                </Link>
            </motion.section>

            <!-- Nos chats -->
            <section class="m-3 mx-auto max-w-3xl overflow-hidden">
                <ul class="flex gap-3">
                    <motion.li
                        class="border-primary flex basis-1/2 flex-col justify-end rounded-bl-xl border-b-2 border-l-2 p-3"
                        :initial="{ opacity: 0, x: -30 }"
                        :in-view="{ opacity: 1, x: 0, transition: { duration: 1, delay: 0 } }"
                        :viewport="{ once: true }"
                    >
                        <img loading="lazy" src="img/reproducteurs.webp" alt="" class="w-10/12 rounded-lg" />
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
                        <img loading="lazy" src="img/chatons.webp" alt="" class="relative top-7 rounded-lg" />
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
                :initial="{ opacity: 0, y: 20 }"
                :in-view="{ opacity: 1, y: 0, transition: { duration: 1, delay: 0 } }"
                :viewport="{ once: true }"
                aria-labelledby="contactez-nous"
            >
                <section class="m-3 mx-auto mt-20 mb-0 flex max-w-3xl flex-col gap-3 rounded-xl bg-[#ABA5A2] p-5 md:gap-5">
                    <div>
                        <h3 id="contactez-nous" class="poetsone text-3xl text-white">Contactez-nous</h3>
                        <p class="text-justify text-white">Envie de procéder à une réservation ? Ou simplement poser une question ?</p>
                    </div>
                    <div class="flex flex-col gap-3 md:flex-row md:gap-5">
                        <div class="grow">
                            <Input
                                v-model="form.nom"
                                type="text"
                                placeholder="Nom"
                                class="rounded-lg bg-white text-black"
                                aria-label="Nom"
                                required
                                maxlength="255"
                            />
                            <p v-if="form.errors.nom" class="text-sm text-red-500">{{ form.errors.nom }}</p>
                        </div>
                        <div class="grow">
                            <Input
                                v-model="form.prenom"
                                type="text"
                                placeholder="Prénom"
                                class="rounded-lg bg-white text-black"
                                aria-label="Prénom"
                                required
                                maxlength="255"
                            />
                            <p v-if="form.errors.prenom" class="text-sm text-red-500">{{ form.errors.prenom }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col gap-3 md:flex-row md:gap-5">
                        <div class="grow">
                            <Input
                                v-model="form.email"
                                type="email"
                                placeholder="Email"
                                class="rounded-lg bg-white text-black"
                                aria-label="Email"
                                maxlength="255"
                            />
                            <p v-if="form.errors.email" class="text-sm text-red-500">{{ form.errors.email }}</p>
                        </div>
                        <div class="grow">
                            <Input
                                v-model="form.telephone"
                                type="text"
                                placeholder="Téléphone"
                                class="rounded-lg bg-white text-black"
                                aria-label="Téléphone"
                                maxlength="255"
                            />
                            <p v-if="form.errors.telephone" class="text-sm text-red-500">{{ form.errors.telephone }}</p>
                        </div>
                    </div>
                    <div>
                        <Textarea
                            v-model="form.message"
                            placeholder="Message"
                            class="h-32 resize-none rounded-lg bg-white text-black"
                            rows="4"
                            aria-label="Message"
                            required
                            maxlength="5000"
                        ></Textarea>
                        <p v-if="form.errors.message" class="text-sm text-red-500">{{ form.errors.message }}</p>
                    </div>

                    <Button type="submit" label="Envoyer" class="self-end" :disabled="form.processing" aria-label="Envoyer le formulaire" />
                </section>
            </motion.form>
        </main>
    </Layout>
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
    font-family: koho, sans-serif;
}
</style>
