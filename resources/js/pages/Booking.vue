<script lang="ts" setup>
import Menu from '@/components/Menu.vue';
import { getContentByTitle } from '@/lib/utils';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import Layout from './Layout.vue';

defineProps<{
    contents: any[];
    faqs: { question: string; answer: string }[];
}>();

const openFaq = ref<number | null>(null);

function toggleFaq(index: number) {
    openFaq.value = openFaq.value === index ? null : index;
}
</script>
<template>
    <Head>
        <title>Réservation et conditions - Chatterie des petits plis</title>
        <meta
            name="description"
            content="Découvrez les conditions d'adoption et les informations sur la réservation chez Chatterie des petits plis, élevage familial de Scottish et British."
        />
        <meta name="keywords" content="réservation, conditions d'adoption, Scottish, British, élevage familial, Chatterie des petits plis" />
        <meta name="author" content="Chatterie des petits plis" />
        <meta property="og:title" content="Réservation et conditions - Chatterie des petits plis" />
        <meta
            property="og:description"
            content="Découvrez les conditions d'adoption et les informations sur la réservation chez Chatterie des petits plis, élevage familial de Scottish et British."
        />
        <meta property="og:image" content="/images/reservation.jpg" />
        <meta property="og:type" content="website" />
    </Head>

    <Layout>
        <Menu title="Réservation et conditions" />
        <div class="mx-auto max-w-3xl lg:mt-20 lg:py-6">
            <div class="relative m-3 mt-12 mb-0 flex-col justify-end p-3 text-justify">
                <div class="border-primary absolute bottom-0 -left-1 h-1/2 w-1/2 rounded-bl-xl border-b-2 border-l-2"></div>
                <div class="border-primary absolute top-0 -right-1 h-1/2 w-1/2 rounded-tr-xl border-t-2 border-r-2"></div>
                <h1 class="text-primary poetsone m-3 mb-6 ml-0 text-3xl">Conditions d'adoption</h1>

                <p class="text-justify" v-html="getContentByTitle('Conditions d\'adoptions', contents)"></p>
            </div>

            <h2 class="text-primary poetsone m-3 mt-10 text-3xl">Réservation</h2>
            <div class="bg-tertiary z-40 m-3 flex flex-col gap-3 rounded-xl p-5">
                <p class="text-justify text-white" v-html="getContentByTitle('Réservation', contents)"></p>
            </div>
            <!-- <h2 class="text-primary poetsone m-3 mt-10 text-3xl">Nos conseils</h2>
            <div class="z-40 m-3 flex flex-col gap-3 rounded-xl bg-[#B5A9A4] p-5">
                <p class="text-justify text-white" v-html="getContentByTitle('Conseils', contents)"></p>
            </div> -->

            <h2 class="text-primary poetsone m-3 mt-10 text-3xl">FAQ</h2>
            <div>
                <div
                    v-for="(faq, index) in faqs"
                    :key="index"
                    class="border-primary bg-primary m-3 rounded-xl border shadow transition-all duration-200"
                >
                    <button
                        @click="toggleFaq(index)"
                        class="flex w-full items-center justify-between p-5 py-2 text-left text-lg font-semibold text-white focus:outline-none"
                    >
                        <span>{{ faq.question }}</span>
                        <svg
                            :class="['transition-transform duration-200', openFaq === index ? 'rotate-180' : '']"
                            width="24"
                            height="24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                        >
                            <path d="M6 9l6 6 6-6" />
                        </svg>
                    </button>
                    <transition name="expand-fade">
                        <div v-if="openFaq === index" class="faq-answer px-5 pb-5 text-justify text-white" v-html="faq.answer"></div>
                    </transition>
                </div>
            </div>
        </div>
    </Layout>
</template>
<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.2s;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

/* Animation pour la FAQ */
.expand-fade-enter-active,
.expand-fade-leave-active {
    transition:
        max-height 0.3s cubic-bezier(0.4, 0, 0.2, 1),
        opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
}
.expand-fade-enter-from,
.expand-fade-leave-to {
    max-height: 0;
    opacity: 0;
}
.expand-fade-enter-to,
.expand-fade-leave-from {
    max-height: 500px; /* valeur suffisamment grande pour le contenu */
    opacity: 1;
}
</style>
