<script lang="ts" setup>
import Menu from '@/components/Menu.vue';
import { getContentByTitle } from '@/lib/utils';
import Layout from './Layout.vue';

defineProps<{
    contents: any[];
}>();
</script>
<template>
    <Head>
        <title>Réservation et conditions - Janssens Family</title>
        <meta
            name="description"
            content="Découvrez les conditions d'adoption et les informations sur la réservation chez Janssens Family, élevage familial de Scottish et British."
        />
        <meta name="keywords" content="réservation, conditions d'adoption, Scottish, British, élevage familial, Janssens Family" />
        <meta name="author" content="Janssens Family" />
        <meta property="og:title" content="Réservation et conditions - Janssens Family" />
        <meta
            property="og:description"
            content="Découvrez les conditions d'adoption et les informations sur la réservation chez Janssens Family, élevage familial de Scottish et British."
        />
        <meta property="og:image" content="/images/reservation.jpg" />
        <meta property="og:url" content="https://www.janssensfamily.be/booking" />
        <meta property="og:type" content="website" />
    </Head>

    <Menu title="Réservation et conditions" />
    <Layout>
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
            <h2 class="text-primary poetsone m-3 mt-10 text-3xl">Nos conseils</h2>
            <div class="z-40 m-3 flex flex-col gap-3 rounded-xl bg-[#B5A9A4] p-5">
                <p class="text-justify text-white" v-html="getContentByTitle('Conseils', contents)"></p>
            </div>
        </div>
    </Layout>
</template>
