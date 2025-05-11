<script lang="ts" setup>
import Footer from '@/components/Footer.vue';
import Menu from '@/components/Menu.vue';
import { getContentByTitle } from '@/lib/utils';
import { Head } from '@inertiajs/vue3';

const props = defineProps<{
    contents: any[];
}>();
</script>
<template>
    <Head>
        <title>Elevage</title>
        <meta name="description" content="Elevage de Scottish Fold et British Shorthair" />
        <meta property="og:title" content="Elevage" />
        <meta property="og:description" content="Elevage de Scottish Fold et British Shorthair" />
        <meta property="og:image" content="/images/elevage.jpg" />
        <meta property="og:url" content="https://www.janssensfamily.be/elevage" />
    </Head>
    <Menu title="Elevage" />
    <div class="m-3 mx-auto my-6 max-w-3xl p-3 lg:mt-20 lg:py-6">
        <h1 class="text-primary poetsone mb-3 text-3xl">Qui sommes-nous ?</h1>
        <p class="text-justify" v-html="getContentByTitle('A propos avant la photographie', props.contents)"></p>

        <div class="relative m-auto mt-12 h-64 w-64 bg-amber-100">
            <div class="absolute -top-3 -left-3 h-52 w-1/2 rounded-lg bg-[#CDC6C2]"></div>
            <div class="absolute -right-3 -bottom-3 h-52 w-1/2 rounded-lg bg-[#CDC6C2]"></div>
            <img src="hadrien-laura.jpg" alt="" class="absolute inset-0 h-full w-full rounded-lg object-cover object-center" />
        </div>
    </div>
    <div class="relative m-3 mx-auto mt-12 mb-0 max-w-3xl flex-col justify-end p-3 text-justify">
        <div class="border-primary absolute bottom-0 -left-1 h-1/2 w-1/2 rounded-bl-xl border-b-2 border-l-2"></div>
        <div class="border-primary absolute top-0 -right-1 h-1/2 w-1/2 rounded-tr-xl border-t-2 border-r-2"></div>
        <p class="text-justify" v-html="getContentByTitle('A propos après la photographie', props.contents)"></p>
    </div>
    <p
        class="grapenuts relative -top-5 mx-auto max-w-3xl pr-5 text-right text-2xl font-bold text-[#51687F]"
        v-html="getContentByTitle('Signature', props.contents)"
    ></p>
    <Footer />
</template>
